(()=>{
    let body = document.body.id;


    function mobileIndex(){
        var mobileCheck = window.matchMedia("(max-width: 767px)").matches
        var landingTitle = document.querySelector('.landing_title');
        // 모바일 메뉴 컨트롤
        var mobileMenu = document.querySelector('.menu_bar');
        var desktopMenu = document.querySelector('.menu_list');
        var xIcon = document.querySelector('.x_icon');
        if(mobileCheck){
            // 화면 사이즈가 모바일인지 체크 
            if(body == "home"){
                landingTitle.innerHTML = "주식회사<br>에이티에스솔루션";
                // index landing h2 줄바꿈
            }
            mobileMenu.addEventListener('click', ()=>{
                // 메뉴 아이콘 클릭시 메뉴 창 나타나고 스크롤 막음
                desktopMenu.classList.add('mobile_menu');
                document.body.style.position = 'fixed';
            })
            xIcon.addEventListener('click', ()=>{
                // x아이콘 클릭시 메뉴 창 사라지고 스크롤 가능
                document.body.style.position = 'relative';
                desktopMenu.classList.remove('mobile_menu');
            })
        } else {
            if(body == "home"){
                landingTitle.innerHTML = "주식회사 에이티에스솔루션";
            }
        }
    }
    mobileIndex();

    function responsiveSlider(){
        // 메인 페이지 이미지 슬라이더
        var slider = document.querySelector('.index_bg');
        var sliderWidth = slider.offsetWidth;
        var sliderList = document.querySelector('.index_bg_list');
        var items = document.querySelectorAll('.index_bg_list li').length; //3
        var prev = document.querySelector('#prev_btn');
        var next = document.querySelector('#next_btn'); 
        var count = 1;

        window.addEventListener('resize',()=>{
            sliderWidth = slider.offsetWidth;
        })

        var prevSlide = function(){
            if(count > 1){
                count = count - 2;
                sliderList.style.left = '-' + count*sliderWidth + 'px';
                count++;
            } else if(count = 1){
                count = items - 1;
                sliderList.style.left = '-' + count*sliderWidth + 'px';
                count++;
            }
        }
        var nextSlide = function(){
            if(count < items) {
                sliderList.style.left = '-' + count*sliderWidth + 'px';
                count++;
            } else if(count = items) {
                sliderList.style.left = '0px';
                count = 1;
            }
        }
        next.addEventListener('click', ()=>{
            nextSlide();
        })
        prev.addEventListener('click', ()=>{
            prevSlide();
        })

        window.setInterval(()=>{
            nextSlide();
        }, 5000);
    }

    function accordion(){
        // FAQ 아코디언
        var acc = document.querySelectorAll('.accordion');
        var panel = document.querySelector('.panel');

        for(var i = 0; i < acc.length; i++){
            acc[i].addEventListener('click', (e)=>{
                e.target.classList.toggle('active');

                var panel = e.target.nextElementSibling;
                if(panel.style.maxHeight){
                    panel.style.maxHeight = null;
                    panel.style.margin = '0';
                } else {
                    panel.style.maxHeight = (panel.scrollHeight) + 'px' ;
                    panel.style.margin = '50px 0';
                }
            })
        }
    }

    function initMap() {
        // 오시는 길 지도 로드
        var here = { lat: 37.617766442962946 ,lng: 127.10399481146221 };
        var map = new google.maps.Map(
          document.getElementById('map'), {
            zoom: 15,
            center: here
        });
        var marker = new google.maps.Marker({position: here, map: map});
    }



    window.addEventListener("load", ()=>{
        if(body == "home"){
            responsiveSlider();
        } else if(body == "company2"){
            initMap();
        } else if(body == "guide") {
            accordion();
        }
    })

    window.addEventListener('resize', ()=>{
        mobileIndex();  
    })
})();