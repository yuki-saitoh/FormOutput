<?php
 
class AdminController extends Zend_Controller_Action
{
    // 認証済み情報
    private $authInfo = array();
 
    // アクション前処理
    public function preDispatch()
    {
        // 認証済み情報を取り出す
        $authStorage = Zend_Auth::getInstance()->getStorage();
        if ($authStorage->isEmpty()) {
            // 認証済み情報がない →ログインページへ
            return $this->_forward('login-page', 'auth');
        }
        $this->authInfo = (array)$authStorage->read();
    }
 
    // デフォルトアクション
    public function indexAction()
    {
        // デフォルト処理いろいろ
    }
 
    // その他のアクション
    public function otherAction()
    {
        // その他の処理いろいろ
    }
}