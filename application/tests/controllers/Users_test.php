<?php

class Users_test extends TestCase
{

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

        $CI =& get_instance();
        $CI->load->library('Seeder');
        $CI->seeder->call('UsersSeeder');
    }

    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('Users_model');
        $this->users_model = $this->CI->Users_model;
    }

    /**
     * @test
     */
    public function 詳細ページに遷移できる()
    {
        $user = $this->users_model->find()[0];

        // Verify
        $output = $this->request('GET', ['Users', 'view', $user['id']]);
        $this->assertContains($user['name'], $output);
    }

    /**
     * @test
     */
    public function 存在しないユーザーの場合は存在しませんページに遷移する()
    {
        $user = $this->users_model->get_users()[0];

        // Verify
        $output = $this->request('GET', ['Users', 'view', $user['id'] + 1]);
        $this->assertContains('User Not Found', $output);
    }

    /**
     * @test
     */
    public function 新規ユーザー登録画面に遷移できる()
    {
        // Verify
        $output = $this->request('GET', ['Users', 'create']);
        $this->assertContains('ユーザー登録', $output);
    }

    /**
     * @test
     */
    public function ユーザー登録できること()
    {
        $before = count($this->users_model->find());

        // Exercise
        $post = [
            'email' => 'email_test_user@example.com',
            'name' => 'ユーザー登録テスト',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];
        $this->request('POST', ['Users', 'create'], $post);

        $after = count($this->users_model->find());

        // 更新前の件数に1件追加されている
        $this->assertEquals($before + 1, $after);

        // TearDown
        $this->request('GET', ['Pages', 'logout']);
    }

    /**
     * @test
     */
    public function バリデーションチェックの確認()
    {
        // Setup
        $before = count($this->users_model->find());

        // 必須チェック
        $post = [
            'email' => '',
            'name' => '',
            'password' => '',
            'password_confirmation' => '',
        ];
        $output = $this->request('POST', ['Users', 'create'], $post);
        $this->assertContains('メールアドレス欄は必須フィールドです', $output);
        $this->assertContains('名前欄は必須フィールドです', $output);
        $this->assertContains('パスワード欄は必須フィールドです', $output);
        $this->assertContains('パスワードの確認欄は必須フィールドです', $output);

        // メールアドレス妥当性チェック
        $post = [
            'email' => 'a',
            'name' => 'ユーザー登録テスト',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];
        $output = $this->request('POST', ['Users', 'create'], $post);
        $this->assertContains('メールアドレス欄はメールアドレスとして正しい形式でなければいけません', $output);

        // パスワード確認チェック
        $post = [
            'email' => 'a',
            'name' => 'ユーザー登録テスト',
            'password' => 'password',
            'password_confirmation' => 'bad_password_conf',
        ];
        $output = $this->request('POST', ['Users', 'create'], $post);
        $this->assertContains('パスワード欄が パスワードの確認欄と同じではありません', $output);

        $after = count($this->users_model->find());

        // 更新前後で件数が変わらない
        $this->assertEquals($before, $after);
    }

    /**
     * @test
     */
    public function ユーザー編集画面に遷移できる()
    {
        // SetUp データ
        $user = array(
            'email' => 'email_user_edit@example.com',
            'name' => 'ユーザー編集画面に遷移できる',
            'password' => sha1('email_user_edit@example.com'.'password'),
            'created_at' => date('Y/m/d H:i:s'),
            'updated_at' => date('Y/m/d H:i:s')
        );
        $this->users_model->save($user);

        // Verify
        $output = $this->request('GET', ['Users', 'edit', $user['id']]);
        $this->assertContains('ユーザー編集', $output);
    }

    /**
     * @test
     */
    public function ユーザーを編集できる()
    {
        // SetUp データ
        $user = array(
            'email' => 'email_user_edit_before@example.com',
            'name' => '変更前',
            'password' => sha1('email_user_edit_before@example.com'.'password'),
            'created_at' => date('Y/m/d H:i:s'),
            'updated_at' => date('Y/m/d H:i:s')
        );
        $this->users_model->save($user);

        $post = [
            'email' => 'email_user_edit_after@example.com',
            'name' => '変更後',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];
        // Exercise
        $this->request('POST', ['Users', 'edit' ,$user['id']], $post);
        $sut = $this->users_model->find($user['id']);

        // Verify
        $this->assertEquals('email_user_edit_after@example.com', $sut['email']);
        $this->assertEquals('変更後', $sut['name']);
        // 詳細ページにリダイレクトする
        $this->assertRedirect('/users/'.$user['id']);
    }
}
