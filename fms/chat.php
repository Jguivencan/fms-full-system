<div id="chat-body"></div>

    <script>
        let html =  `<iframe src="http://localhost/system/chatsystem/users.php" style = "height: 100vh; width: 100%" title ="chat"></iframe>`                  
        // errorText = document.querySelector(".error-text");
        const div = document.getElementById("chat-body");
        
        main_reg = function(){
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "http://localhost/system/chatsystem/php/signup.php", true);
            xhr.onload = ()=>{
                    if(xhr.readyState === XMLHttpRequest.DONE){
                        if(xhr.status === 200){
                            let data = xhr.response;
                            
                            if(data === "login"){
                                
                            // div.innerHTML = html;
                                login()
                            }
                            if(data === "success"){
                                //location.reload(); 
                                div.innerHTML = html;
                            }
                            // else{
                            //     errorText.style.display = "block";
                            //     errorText.textContent = data;
                            // }
                        }
                    }
            }
            let formData = new FormData();
            formData.append('fname', "<?php echo $_SESSION['login_name'] ?>" );
            formData.append('is_api','1' );
            formData.append('lname', "null" );
            formData.append('email', "<?php echo  $_SESSION['login_username']?>");
            formData.append('password' , "<?php echo  $_SESSION['login_password']?>" );
            xhr.send(formData);
        }

        login = function (){
            let xhrl = new XMLHttpRequest();
            xhrl.open("POST", "http://localhost/system/chatsystem/php/login.php", true);
            xhrl.onload = ()=>{
                if(xhrl.readyState === XMLHttpRequest.DONE){
                    if(xhrl.status === 200){
                        let data = xhrl.response;
                        if(data === "success"){
                            div.innerHTML = html;
                        }
                        console.log(data);
                    }
                }
            }
            let formData = new FormData();
            formData.append('email', "<?php echo  $_SESSION['login_username']?>");
            formData.append('password' , "<?php echo  $_SESSION['login_password']?>" );
            xhrl.send(formData);
        }
        
        main_reg(); 
    </script>