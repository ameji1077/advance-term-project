<nav class="nav" id="nav">
  <ul>
    <li><a href="/">Home</a></li>
    <li>
      <form action="{{route('logout')}}" method="POST">
        @csrf
        <input type="submit" class="logoutBtn" value="Logout">
      </form>
    </li>
    <li><a href="/mypage">Mypage</a></li>
  </ul>
</nav>
<div class="header-content">
  <div class="menu" id="menu">
    <img src="{{asset('images/menu.png')}}" alt="メニュー" class="menuBtn" id="menuBtn">
    <img src="{{asset('images/close_btn.png')}}" alt="閉じるボタン" class="closeBtn" id="closeBtn">
  </div>
  <h1 class="logo"><a href="/">Rese</a></h1>
</div>

<style>
.logo{
  font-size: 32px;
}
a{
  text-decoration: none;
  color: blue
}
.nav{
  position: absolute;
  height: 100vh;
  width: 100%;
  top: 0;
  left: -100%;
  background: #fff;
  transition: .7s;
  text-align: center;
  z-index: 1;
}
.nav ul{
  padding-top: 150px;
}
.nav ul li{
  list-style-type: none;
  margin-top: 30px;
  font-size: 24px;
}
.logoutBtn{
  border: none;
  color: blue;
  background: #fff;
  font-size: 24px;
  cursor: pointer;
}
.header-content{
  display: flex;
  align-items: center;
}
.menu {
  z-index: 2;
  margin-right: 10px
}
.menuBtn{
  display: block;
}
.closeBtn{
  display: none;
}
.block{
  display: block;
}
.none{
  display: none;
}
.in{
  transform: translateX(100%);
}
.out{
  transform: translateX(-100%);
}
</style>

<script>
  const target = document.getElementById("menu");
  const menuBtn = document.getElementById("menuBtn");
  const closeBtn = document.getElementById("closeBtn");
  const nav = document.getElementById("nav");
  target.addEventListener('click', () => {
    nav.classList.toggle('in');
    menuBtn.classList.toggle('none');
    closeBtn.classList.toggle('block');
  });
</script>