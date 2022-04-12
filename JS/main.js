    let body = document.body.id;

    function login(){
        // login modal 펴고 닫기
        const btn = document.querySelector('.loginModalBtn');
        const modal = document.querySelector('.loginModal');
        
        if(modal){
            modal.style.right = '-200px'; // 바로 작동시키기 위해 값을 미리 설정해둠
            btn.addEventListener('click', ()=>{
                if(modal.style.right == '-200px') {
                    modal.style.right = 0;
                } else {
                    modal.style.right = '-200px';
                }
            })
        }
    }

    function mobileIndex(){
        var mobileCheck = window.matchMedia("(max-width: 879px)").matches;
        var landingTitle = document.querySelector('.landing_title');
        // 모바일 메뉴 컨트롤
        var hamburger = document.querySelector('.menu_bar');
        var desktopMenu = document.querySelector('.menu_list');
        var dropToggle = document.querySelectorAll('.dropdown_toggle>p');
        var dropMenu = document.querySelectorAll('.dropdown_menu');
        var xIcon = document.querySelector('.x_icon');
        var header = document.querySelector('.header');
        
        if(mobileCheck){
            // 화면 사이즈가 모바일인지 체크 
            if(body == "home"){
                landingTitle.innerHTML = "주식회사<br>에이티에스솔루션";
                // index landing h2 줄바꿈
            }
            hamburger.addEventListener('click', function(){
                // 메뉴 아이콘 클릭시 메뉴 창 나타남
                desktopMenu.classList.add('mobile_menu');
                
                for(var i=0; i<dropToggle.length; i++){
                    // dropdown 메뉴 활성화
                    dropToggle[i].addEventListener('click',function(e){
                        dropMenu = e.target.nextElementSibling;
                        if(dropMenu.style.display === 'block'){
                            // 메뉴가 열려있을 경우
                            dropMenu.style.display = 'none';
                        } else {
                            // 메뉴가 닫혀있는 경우
                            dropMenu.style.display = 'block';
                        }
                    })
                }
            })
            window.addEventListener('mouseup', function(e){
                // 외부영역 클릭 시 메뉴 닫기
                if(!e.target.classList.contains('mobile_menu')){
                    desktopMenu.classList.remove('mobile_menu');
                }
            })
            xIcon.addEventListener('click', function(){
                // x아이콘 클릭시 메뉴 창 사라짐
                desktopMenu.classList.remove('mobile_menu');
            })
            window.addEventListener('scroll', function(){
                header.style.position = 'sticky';
                header.style.opacity = '0.85'
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
        var scrollBar = window.innerWidth - slider.offsetWidth;
        var sliderWidth = slider.offsetWidth + scrollBar;
        var sliderList = document.querySelector('.index_bg_list');
        var items = document.querySelectorAll('.index_bg_list li').length; //3
        var img = document.querySelectorAll('.index_bg_list li img');
        var prev = document.querySelector('#prev_btn');
        var next = document.querySelector('#next_btn'); 
        var count = 1;


        window.addEventListener('resize',function(){
            sliderWidth = slider.offsetWidth + scrollBar;
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
        next.addEventListener('click', function(){
            nextSlide();
        })
        prev.addEventListener('click', function(){
            prevSlide();
        })

        window.setInterval(function(){
            nextSlide();
        }, 3000);
    }

    function accordion(){
        // FAQ 아코디언
        var acc = document.querySelectorAll('.accordion');
        var panel = document.querySelector('.panel');

        for(var i = 0; i < acc.length; i++){
            acc[i].addEventListener('click', function(e){
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
        // 오시는 길 지도 로드 (네이버 map api 사용)
        const mapOptions ={
            center: new naver.maps.LatLng(37.617766442962946, 127.10399481146221),
            zoom: 15
        };
        const map = new naver.maps.Map('map', mapOptions);
        const marker = new naver.maps.Marker({
            position: new naver.maps.LatLng(37.617766442962946, 127.10399481146221),
            map: map
        });
    }

    function replyControl(){
        // 댓글 수정 & 삭제
        var modiTarget = document.querySelectorAll('.replyModiModal[data-target]'); // 수정하기 버튼
        var deleteTarget = document.querySelectorAll('.replyDeleteModal[data-target]'); // 지우기 버튼
        

        Array.prototype.forEach.call(modiTarget, function(target){
            // 수정하기 버튼 활성화
            target.addEventListener('click', function(e){
                var s = target.nextElementSibling;
                s.classList.toggle('modalActive');
                e.stopPropagation();
            })
        })
        Array.prototype.forEach.call(deleteTarget, function(target){
            // 지우기 버튼 활성화
            target.addEventListener('click', function(e){
                var s = target.nextElementSibling;
                s.classList.toggle('modalActive');
                e.stopPropagation();
            })
        })
    }
    replyControl();

    function loadScroll(){
        window.scroll(0, 0);
    }


    window.addEventListener("load", function(){
        // 페이지 로드 시 페이지 상단으로 이동
        window.history.scrollRestoration = "manual";

        login();
        // 페이지별 수정사항
        if(body == "home"){
            responsiveSlider();
        } else if(body == "company2"){
            initMap();
        } else if(body == "guide") {
            accordion();
        }
    })

    window.addEventListener('resize', function(){
        mobileIndex(); 
    })

    window.onload = loadScroll();
