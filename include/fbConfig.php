<?phpcredits()
/* Configuracion basica de Facebook SDK */

$appId         = 'InsertAppID'; //Facebook App ID
$appSecret     = 'InsertAppSecret'; //Facebook App Secret
$redirectURL   = 'http://localhost/facebook_post_from_website/'; //Llamando URL
$fbPermissions = array('publish_actions'); //Facebook permisos

$fb = new Facebook(array(
    'app_id' => $appId,
    'app_secret' => $appSecret,
    'default_graph_version' => 'v2.2',
));

?>