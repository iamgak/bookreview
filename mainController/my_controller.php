<?php 
class my_controller {

    public function index(){
        require($_SERVER['DOCUMENT_ROOT'].'/controller/index.php');
    }
    
    public function register(){
        require($_SERVER['DOCUMENT_ROOT'].'/controller/register.php');
    }
    
    public function api(){
        require($_SERVER['DOCUMENT_ROOT'].'/controller/api.php');
    }
    
    public function login(){
        require($_SERVER['DOCUMENT_ROOT'].'/controller/login.php');
    }

    public function logout(){
        require($_SERVER['DOCUMENT_ROOT'].'/controller/logout.php');
    }
    public function contact_us(){
        require($_SERVER['DOCUMENT_ROOT'].'/controller/contact_us.php');
    }
    
    public function user_activation($activation_token){
        require($_SERVER['DOCUMENT_ROOT'].'/controller/user_activation.php');
    }
    
    public function edit_profile(){
        require($_SERVER['DOCUMENT_ROOT'].'/controller/edit_profile.php');
    }
    
    public function reset_password($activation_token){
        require($_SERVER['DOCUMENT_ROOT'].'/controller/reset_password.php');
    }
    
    public function post_ad(){
        require($_SERVER['DOCUMENT_ROOT'].'/controller/post_ad.php');
    }
    
    public function review_listing($search_uri=''){
        require($_SERVER['DOCUMENT_ROOT'].'/controller/review_listing.php');
    }

    public function change_passwd($search_uri=''){
        require($_SERVER['DOCUMENT_ROOT'].'/controller/change_password.php');
    }
 
    public function review_listing_search($search_uri=''){
        require($_SERVER['DOCUMENT_ROOT'].'/controller/review_listing.php');
    }

    public function user_review(){
        $this->edit_review('');
        exit;
        require($_SERVER['DOCUMENT_ROOT'].'/controller/my_ads.php');
    }
    
    public function my_review(){
        require($_SERVER['DOCUMENT_ROOT'].'/controller/my_ads.php');
    }

    public function edit_review($pid){
        require($_SERVER['DOCUMENT_ROOT'].'/controller/user_review.php');
    }

   public function forget_password(){
        require($_SERVER['DOCUMENT_ROOT'].'/controller/forget_password.php');
    }
    public function error404(){
        require($_SERVER['DOCUMENT_ROOT'].'/controller/error404.php');
    }    
    public function success(){
        require($_SERVER['DOCUMENT_ROOT'].'/controller/files.php');
    }    
    public function listing($search_uri = ''){
        require($_SERVER['DOCUMENT_ROOT'].'/controller/listing.php');
    }    

    public function user_ads_listing(){
        require($_SERVER['DOCUMENT_ROOT'].'/controller/user_ads_listing.php');
    }    
    
    // for admin 
    public function user_listing(){
        require($_SERVER['DOCUMENT_ROOT'].'/controller/Admin/user_listing.php');
    }    

    public function user_info($user_id){
        require($_SERVER['DOCUMENT_ROOT'].'/controller/Admin/user_info.php');
    }    

    
    public function admin_listing($search_uri=''){
        require($_SERVER['DOCUMENT_ROOT'].'/controller/Admin/listing.php');
    }    

    public function contact_listing(){
        require($_SERVER['DOCUMENT_ROOT'].'/controller/Admin/contact_listing.php');
    }    

    public function admin_login(){
        require($_SERVER['DOCUMENT_ROOT'].'/controller/Admin/login.php');
    }
    
    public function dashboard(){
        require($_SERVER['DOCUMENT_ROOT'].'/controller/Admin/home.php');
    }
    
}
