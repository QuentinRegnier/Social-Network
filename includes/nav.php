<nav class="nav_bar nonSelectionnableindex" style="position: fixed; z-index: 10000;margin-top: 0;">
	<img src="IMG/favicon.png" class="img_nav_bar">
	</div>
	<div id="hamburger" class="hamburglar is-closed pasblock nav-bar-burg hamburger-nav">
	  	<div class="burger-icon">
		    <div class="burger-container">
		      	<span class="burger-bun-top burger-bun-top-nav"></span>
		      	<span class="burger-filling burger-filling-nav"></span>
		      	<span class="burger-bun-bot burger-bun-bot-nav"></span>
		    </div>
	  	</div>
	  	<div class="burger-ring">
	  	</div>
	  	<div class="path-burger">
	    	<div class="animate-path">
	      		<div class="path-rotation"></div> 
	    	</div>
		</div>
	</div>
	<a href="<?= $resultat8['pseudo'] ?>" class="content_user"><img src="img_user/<?= $pp ?>" class="img_user"><label class="name_user"><?= $resultat8['pseudo'] ?></label></a>
	<div style="margin-right: auto; margin-left: auto;" class="content_li_nav">
		<ul class="listnav_bar">
			<li class="linav_bar linav1"><a href="#"><img src="IMG/home.png" class="imgnav_bar"></a></li>
			<li class="linav_bar linav2"><a href="#"><img src="IMG/friend.png" class="imgnav_bar"></a></li>
			<li class="linav_bar linav3"><a href="#"><img src="IMG/message.png" class="imgnav_bar"></a></li>
			<li class="linav_bar linav4"><a href="#"><img src="IMG/group.png" class="imgnav_bar"></a></li>
		</ul>
	</div>
</nav>
<div id="content_reduce_nav">
	<ul class="ULNAVREDUCE">
			<a href="/" style="text-decoration: none;"><li class="LINAVREDUCE"><img src="IMG/home.png" class="imgnav_bar"><span class="SPANNAVREDUCE">Home</span></li></a>
			<a href="#" style="text-decoration: none;"><li class="LINAVREDUCE"><img src="IMG/friend.png" class="imgnav_bar"><span class="SPANNAVREDUCE">Amis</span></li></a>
			<a href="#" style="text-decoration: none;"><li class="LINAVREDUCE"><img src="IMG/message.png" class="imgnav_bar"><span class="SPANNAVREDUCE">Messages</span></li></a>
			<a href="#" style="text-decoration: none;"><li class="LINAVREDUCE"><img src="IMG/group.png" class="imgnav_bar"><span class="SPANNAVREDUCE">Groupes</span></li></a>
	</ul>
</div>
<style type="text/css">
	#content_reduce_nav {
		display: none;
		position: fixed;
		background: #1f0bd9;
		z-index: 1000;
		width: 100%;
		height: 100%;
	}
	.img_nav_bar{
	  width: 48px;
	  height: 48px;
	  float: left;
	  margin-top: 6px;
	  margin-left: 15px;
	  position: absolute;
	}
	.imgnav_bar{
	  width: 45px;
	  height: 45px;
	  margin-top: 2px;
	}
	.linav_bar{
	  list-style: none;
	  display: inline-block;
	}
	.nav_bar{
	  background-color: #1f0bd9;
	  height: 60px;
	  width: 100%;
	  margin-top: -60px;
	}
	.listnav_bar{
	  text-align: center;
	  width: 100%;
	}
	.linav_bar{
	  margin-top: 5px;
	}
	.linav2, .linav3, .linav4{
	  margin-left: 100px;
	}
	.linav1{
	  margin-left: 163px;
	}
	.img_user{
	  width: 40px;
	  height: 40px;
	  margin-right: 14px;
	  border-radius: 20px;
	}
	.name_user{
	  font-size: 25px;
	  color: #ffff;
	  font-family: 'Pacifico', cursive;
	  margin-right: 20px;
	  vertical-align: top;
	  cursor: pointer;
	}
	.content_user{
	  float: right;
	  margin-top: 10px;
	  text-decoration: none;
	}
	.nonSelectionnableindex, span, li, h1, .nonSelectionnable{
	  -moz-user-select: none; /* Firefox */
	  -webkit-user-select: none; /* Chrome, Safari, Opéra depuis la version 15 */
	  -ms-user-select: none; /* Internet explorer depuis la version 10 et Edge */
	  user-select: none; /* Propriété standard */
	}
	.ULNAVREDUCE{
		margin-top: 80px;
	}
	.LINAVREDUCE {
		padding: 10px;
		border-bottom: #fff solid 1px;
		cursor: pointer;
		height: 80px;
	}
	.SPANNAVREDUCE {
		color: white;
		font-size: 25px;
		font-weight: bold;
		vertical-align: super;
		margin-left: 20px;
	}
	@media screen and (max-width: 899px){
		.nav-bar-burg{
		  float: right;
		  right: 0;
		  display: block;
		  cursor: pointer;
		}
		.content_li_nav{
		  display: none;
		}
		.burger-bun-top-nav, .burger-bun-bot-nav, .burger-filling-nav {
		  background: #fff;
		}
		.content_user{
		  margin-right: 0px;
		}
		.name_user{
			margin-left: 10px;
		}
		.img_user {
			margin-right: 0px;
			margin-left: -40px;
		}
	}
</style>
<script type="text/javascript">
	var isClosednav;
	function burgerTimenav() {
		 if (isClosednav == true) {
		    trigger.removeClass('is-open');
		    trigger.addClass('is-closed');
		    isClosednav = false;
		 } else {
		    trigger.removeClass('is-closed');
		    trigger.addClass('is-open');
		    isClosednav = true;
		}
	}
	function start_menu_nav(){
		elem_selt = document.querySelector('#content_reduce_nav');
		if (isClosednav) {
			elem_selt.style.display = "block";
		}else{
			elem_selt.removeAttribute('style');	
		}
	}
	function ham_linav(){
		if (window.innerWidth <= 899){
			isClosednav = false;
	    	trigger_burg = document.querySelector('.hamburger-nav');
	    	trigger_burg.className = 'hamburglar is-closed pasblock nav-bar-burg hamburger-nav';
			start_menu_nav();
		}
	}
</script>