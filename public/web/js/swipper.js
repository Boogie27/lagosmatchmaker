









    swipper_container = document.querySelector(".infiniteSwipper")
    
    class infinitSwipper{
        constructor(swipper){
            this.width = 0
            this.counter = 0
            var action = this
            this.frameSize = 0
            this.itemWith = 0
            this.is_down = false
            this.is_moving = false
            this.stopPosition = 0
            this.initialposition = null
            this.swipperContainer = swipper
            this.swipperFrame = this.swipperContainer.querySelector('.swipper-frame')
            this.swipperItems = this.swipperFrame.children
            this.totalFrames = this.swipperItems.length
    
            
            this.horizontal() // set items horizontal
            this.add_frames()
            this.start_position()

            this.swipperFrame.onmousedown = function(e){
                // action.onDown(e)
            }


            this.swipperFrame.onmousemove = function(e){
                // action.onMoving(e)
            }

            this.swipperFrame.onmouseup = function(e){
                // action.onUp(e)
            }

            this.auto_swipe(action)
            
            this.swipperFrame.ontransitionend = function(e){
                action.update_swipper()
            }

        }
    
        horizontal(){
            var screen = window.innerWidth
            var containerWidth = this.swipperContainer.clientWidth

            screen = Math.round(screen)
            this.width = screen
    
            if(screen > 1125){
                this.counter = 4
                this.itemWith = 5
                this.frameSize = containerWidth / 5
            }
            if(screen > 992 && screen < 1125){
                this.counter = 3
                this.itemWith = 4
                this.frameSize = containerWidth / 4
            }
            if(screen > 767 && screen < 992){
                this.counter = 2
                this.itemWith = 3
                this.frameSize = containerWidth / 3
            }
            if(screen > 567 && screen < 767){
                this.counter = 1
                this.itemWith = 2
                this.frameSize = containerWidth / 2
            }
            if(screen <= 567){
                this.counter = 0
                this.itemWith = 1
                this.frameSize = containerWidth / 1
            }
            this.swipperFrame.style.display = "flex"

            for(var i = 0; i < this.totalFrames; i++){
                this.swipperItems[i].style.width = this.frameSize + "px"
            }
        }

        onDown(e){
            this.is_down = true
            this.initialposition = e.pageX
            var transformMatrix = getComputedStyle(this.swipperFrame).getPropertyValue('transform')
            if(transformMatrix != 'none'){
                this.stopPosition =  parseInt(transformMatrix.split(",")[4].trim());
            }
        }
    
        onMoving(e){
            if(this.is_down){
                this.is_moving = true
                var currentPosition = e.pageX
                var difference = currentPosition - this.initialposition
                this.swipperFrame.style.transform = `translateX(${this.stopPosition + difference}px)`
                console.log(this.stopPosition + difference)
            }
        }

        onUp(e){
            if(this.is_down){
                this.is_down = false
                this.is_moving = false
                //  console.log('end')
            }
        }


        start_position(){
            var item_width = parseInt(this.swipperItems[0].offsetWidth)
            this.swipperFrame.style.transform = `translateX(-${ this.counter * item_width }px)`
        }
    



        add_frames(){
            var items
            var back = 0
            var front = 0
            var elements = []
            
            if(this.width > 1125){
                back = 5
            }
            if(this.width > 992 && this.width < 1125){
                back = 4
            }
            if(screen > 767 && screen < 992){
                back = 3
            }
            if(screen > 567 && screen < 767){
                back = 2
            }
            for(var i = 0; i < back; i++){
                var items = this.swipperItems[i].cloneNode(true)
                this.swipperFrame.appendChild(items);
            }
            
            front = (this.swipperItems.length - back) - 1
            for(var i = front ; i >= 0; i -= 1){ 
                if(i >= back - 1){
                    var items = this.swipperItems[i].cloneNode(true)
                    elements.push(items)
                }
            }
            for(var i = 0; i < elements.length; i++){
                this.swipperFrame.prepend(elements[i]);
            }
        }


        auto_swipe(action){
            var action = action
            function swipe_timer(){
                action.counter++
                action.swipperFrame.style.transition = "all 0.5s ease";
                action.swipperFrame.style.transform = `translateX(-${ action.counter * action.frameSize }px)`
                console.log(action.counter)
                setTimeout( function(){ swipe_timer() }, 5000 )
            }
            swipe_timer()
        }



        update_swipper(){
            var frame = this.swipperItems.length - this.itemWith
            if(this.counter >= frame){
                this.counter = this.itemWith
                this.swipperFrame.style.transition = "none";
                this.swipperFrame.style.transform = `translateX(-${ this.counter * this.frameSize }px)`
            }
        }
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    swipper = new infinitSwipper(swipper_container)
    
    
    
    
    
    
    
    
    
    
    
    