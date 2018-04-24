<?php
 
class AuthController extends Zend_Controller_Action
{
    const AUTH_TABLE_NAME = 'admin';
    const AUTH_ID_NAME    = 'loginid';
    const AUTH_PASS_NAME  = 'password';
 
    private $errmsg = array();
 
    // デフォルトアクション
    public function indexAction()
    {
        // ログインページへ
        return $this->_forward('login-page');
    }
 
    // ログインページ
    public function loginPageAction()
    {
        $this->renderScript('login.php');  // ログインページのビュースクリプトを指定
    }
 
    // ログイン
    public function loginAction()
    {
        $dbAdapter = new Zend_Db_Adapter_Pdo_Mysql(array(
                            'host'     => 'localhost',
                            'username' => 'root',
                            'password' => '',
                            'dbname'   => 'formoutput'
                         ));
        $authAdapter = new Zend_Auth_Adapter_DbTable(
                               $dbAdapter,
                               self::AUTH_TABLE_NAME,
                               self::AUTH_ID_NAME,
                               self::AUTH_PASS_NAME);
        // リクエストパラメータ
        $loginid  = $this->getRequest()->getParam('loginid', '');
        $password = $this->getRequest()->getParam('password', '');
        if ($loginid === '' || $password === '') {
            // そもそもIDまたはパスワードがない →認証NG →ログインページへ
            return $this->_forward('login-page');
        }
        // IDとパスワードをセットする
        $authAdapter->setIdentity($loginid);
        $authAdapter->setCredential($password);
        // 認証する
        $result = $authAdapter->authenticate();
        if ($result->isValid() === FALSE) {
            // 認証NG →ログインページへ
            return $this->_forward('login-page');
        }
        // 認証OK →認証済み情報をストレージ（セッション）に格納
        $storage = Zend_Auth::getInstance()->getStorage();
        $resultRow = $authAdapter->getResultRowObject(array('loginid', 'personname'));
        $storage->write($resultRow);
        // セッションID再生成
        $ret = session_regenerate_id(true);
        // ログイン後のデフォルトアクションへ
        return $this->_forward('index', 'admin');
    }
 
    // ログアウト
    public function logoutAction()
    {
        // 認証済み情報をストレージから削除
        $authStorage = Zend_Auth::getInstance()->getStorage();
        $authStorage->clear();
        // ログインページへ
        return $this->_forward('login-page');
    }
 
}