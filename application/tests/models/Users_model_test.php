<?php
/**
 * Created by PhpStorm.
 * User: DaikiTakeuchi
 * Date: 2015/09/14
 * Time: 1:41
 */

class Users_model_test extends TestCase
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
        $this->obj = $this->CI->Users_model;
    }

    /**
     * @test
     */
    public function ユーザーを全件取得()
    {
        $expected = 3;
        $actual = $this->obj->get_users();
        $this->assertEquals($expected, count($actual));
    }

    /**
     * @test
     */
    public function idを指定してユーザーを取得()
    {

        // setUp
        $users = array(
            'email' => 'email4@example.com',
            'name' => '名前４',
            'password' => sha1('email4@example.com'.'password'),
            'created_at' => date('Y/m/d H:i:s'),
            'updated_at' => date('Y/m/d H:i:s')
        );
        $this->obj->save($users);

        // test
        $expected = $users;
        $actual = $this->obj->get_users($users['id']);
        $this->assertEquals(sort($expected), sort($actual));

        // tearDown
        $this->obj->delete($users);
    }

    /**
     * @test
     */
    public function emaiilを指定してユーザーを取得()
    {
        $expected = 'email1@example.com';
        $sut = $this->obj->get_users_by_email($expected);
        $this->assertEquals($expected, $sut['email']);
    }

    /**
     * @test
     */
    public function ユーザーを新規登録する()
    {
        // setUp
        $users = array(
            'email' => 'email5@example.com',
            'name' => '名前５',
            'password' => sha1('email5@example.com'.'password'),
            'created_at' => date('Y/m/d H:i:s'),
            'updated_at' => date('Y/m/d H:i:s')
        );
        $this->obj->save($users);

        // tearDown
        $this->obj->delete($users);
    }

    /**
     * @test
     */
    public function ユーザーを更新する()
    {
        $expected = '名前６＿更新後';

        // setUp
        $users = array(
            'email' => 'email6@example.com',
            'name' => '名前６',
            'password' => sha1('email6@example.com'.'password'),
            'created_at' => date('Y/m/d H:i:s'),
            'updated_at' => date('Y/m/d H:i:s')
        );
        $this->obj->save($users);

        $sut = $this->obj->get_users($users['id']);
        $sut['name'] = $expected;

        // test
        $this->obj->save($sut);

        $actual = $this->obj->get_users($users['id'])['name'];

        $this->assertEquals($expected, $actual);

        // tearDown
        $this->obj->delete($users);
    }

    /**
     * @test
     */
    public function can_log_inでログインできる事を確認できる()
    {
        // setUp
        $users = array(
            'email' => 'email7@example.com',
            'name' => '名前７',
            'password' => sha1('email7@example.com'.'password'),
            'created_at' => date('Y/m/d H:i:s'),
            'updated_at' => date('Y/m/d H:i:s')
        );
        $this->obj->save($users);

        $this->assertTrue($this->obj->can_log_in('email7@example.com', 'password'));
        // tearDown
        $this->obj->delete($users);
    }

    /**
     * @test
     */
    public function 存在しないユーザーの場合can_log_inでログインできない()
    {
        // setUp
        $users = array(
            'email' => 'email8@example.com',
            'name' => '名前８',
            'password' => sha1('email8@example.com'.'password'),
            'created_at' => date('Y/m/d H:i:s'),
            'updated_at' => date('Y/m/d H:i:s')
        );
        $this->obj->save($users);

        $this->assertFalse($this->obj->can_log_in('email_not_exist@example.com', 'password'));
        // tearDown
        $this->obj->delete($users);
    }
}
