(()=>{
    function responsiveSlider(){
        var slider = document.querySelector('.index_bg');
        var sliderWidth = slider.offsetWidth;
        var sliderList = document.querySelector('.index_bg_list');
        var items = document.querySelectorAll('.index_bg_list li').length;
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

        setInterval(()=>{
            nextSlide()
        }, 3000);
    }

    function accordion(){
        var acc = document.querySelectorAll('.accordion');
        var panel = document.querySelector('.panel');

        for(var i = 0; i < acc.length; i++){
            acc[i].addEventListener('click', (e)=>{
                console.log(e);
                e.target.classList.toggle('active');

                var panel = e.target.nextElementSibling;
                if(panel.style.maxHeight){
                    panel.style.maxHeight = null;
                } else {
                    panel.style.maxHeight = (panel.scrollHeight + 100) + 'px' 
                }
            })
        }
    }
    accordion();
    window.onload = ()=>{
        responsiveSlider();
        accordion();
    }

    window.addEventListener('resize', ()=>{
        
    })
})();