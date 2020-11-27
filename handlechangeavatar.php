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
    'https://png.pngtree.com/png-clipart/20190921/original/pngtree-user-avatar-boy-png-image_4693645.jpg',
    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSrSCJhs6gadfs7pvBTeCLuqVRqNvsRlM__6w&usqp=CAU',
    'https://www.amongusavatarmaker.com/Assets/PLAYER/ORANGE.png',
    'https://cdn3.iconfinder.com/data/icons/diversity-avatars-vol-2/64/captain-jack-sparrow-pirate-carribean-512.png',
    'https://s-media-cache-ak0.pinimg.com/originals/54/0d/ca/540dcabe5f6d2bb94b5a4052ceae0df8.png',
    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTHnv8LCaD8_7urrpxxT9AswgonrU3VqSfIFA&usqp=CAU'
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
https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSrSCJhs6gadfs7pvBTeCLuqVRqNvsRlM__6w&usqp=CAU
https://www.amongusavatarmaker.com/Assets/PLAYER/ORANGE.png
https://cdn3.iconfinder.com/data/icons/diversity-avatars-vol-2/64/captain-jack-sparrow-pirate-carribean-512.png
https://s-media-cache-ak0.pinimg.com/originals/54/0d/ca/540dcabe5f6d2bb94b5a4052ceae0df8.png
https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTHnv8LCaD8_7urrpxxT9AswgonrU3VqSfIFA&usqp=CAU
-->