<?php

include('auth.php');

$auth = new Account();

$id = $auth->check();

$avatar_id = array(
    'https://imgur.com/I80W1Q0.png',
    'https://bootdey.com/img/Content/avatar/avatar7.png',
    'https://happyfacesparty.com/wp-content/uploads/2019/06/avataaars-Brittany.png',
    'https://tunisaid.org/wp-content/uploads/2019/03/avataaars-2.png',
    'https://koolinus.files.wordpress.com/2019/03/avataaars-e28093-koolinus-1-12mar2019.png?w=640',
    'https://happyfacesparty.com/wp-content/uploads/2014/10/avataaars-Shaill.png',
    'https://png.pngtree.com/png-clipart/20190921/original/pngtree-user-avatar-boy-png-image_4693645.jpg'
);

if ($id !== NULL) {
    $q = $_GET['q'];
    // echo $avatar_id[$q];
    $sql = "update accounts SET avatar='".$avatar_id[$q]."' where account_id='".$id."'";
    getConn()->query($sql);

    header('Location: loggedin_profile.php');
}

?>

<!-- 
    
https://imgur.com/I80W1Q0.png
https://bootdey.com/img/Content/avatar/avatar7.png
https://happyfacesparty.com/wp-content/uploads/2019/06/avataaars-Brittany.png
https://tunisaid.org/wp-content/uploads/2019/03/avataaars-2.png
https://koolinus.files.wordpress.com/2019/03/avataaars-e28093-koolinus-1-12mar2019.png?w=640
https://happyfacesparty.com/wp-content/uploads/2014/10/avataaars-Shaill.png
https://png.pngtree.com/png-clipart/20190921/original/pngtree-user-avatar-boy-png-image_4693645.jpg
-->