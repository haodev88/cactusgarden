{{-- <div class="navbar nav_title" style="border: 0;">
    <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentellela Alela!</span></a>
</div> --}}
<?php 
	$u = Auth::user()->avatar;
?>
<div class="clearfix"></div>
<!-- menu profile quick info -->
<div class="profile">
    <div class="profile_pic">
        <img src="/uploads/avatars/{{  Auth::user()->avatar }}" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
        <span>Xin chào,</span>
        <h2>{{ Auth::user()->username }}</h2>
    </div>
</div>
<!-- /menu profile quick info -->
