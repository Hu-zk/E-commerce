const pages = {}

pages.base_url = "http://127.0.0.1:8000/api/";

pages.print_message = (message) =>{
    console.log(message);
}

pages.postAPI = async (api_url, api_data) => {

    try{
        return await fetch(api_url,{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(api_data)
        })
        .then(res =>{
            return res.json()
        } )
        .then(data => {
            console.log(data)
            return data
        })
    
    }catch(error){
        pages.print_message("Error from Linking (POST) " + error)
    }
}

pages.submit = (page) => {
    console.log("submit")
    const form = document.getElementById("form")

    form.addEventListener('submit', event => {
        
        console.log("i am in submit")
        event.preventDefault()

        const password = document.getElementById("password")
        const check_password = document.getElementById("check-password")
        
        const forgot_div = document.getElementById("forgot")
        const existingError = document.getElementById("error-message");
        if (existingError) {
            form.removeChild(existingError);
        }

        const passwordError = document.getElementById("error-password");
        if (passwordError) {
            forgot_div.removeChild(passwordError);
        }

        if(page=="login" || password.value === check_password.value){
            const form_data = new FormData(form)
            const data = Object.fromEntries(form_data)
            console.log(data)
            pages.loadFor(page,data)
        }else {
            
            const errorDiv = document.createElement("div");
            errorDiv.innerText = "Passwords do not match. Try again.";
            errorDiv.id = "error-message";
            form.appendChild(errorDiv);
        }
    })
}

pages.page_signup = async (data) => {
    console.log("i am in register")
    const signup_url = pages.base_url + "sign_up"
    const response = await pages.postAPI(signup_url,data)
    if (response.status === "success") {
        console.log(response.message)
        window.location.href = 'templates/log_in.html';        
    }else{
        console.log(response.message)
    }
}

pages.page_login = async (data) => {
    console.log("i am in login")
    const login_url = pages.base_url + "sign_in"
    const response = await pages.postAPI(login_url,data)
    const forgot_div = document.getElementById("forgot")
    localStorage.removeItem('myData')

    if (response.status === "logged in") {
        localStorage.setItem('myData', JSON.stringify(response));

        if(response.user.type === "user"){
            window.location.href = `./store.html`;
        }else{
            window.location.href = `./admin-read.html`;
        }
        
    }else{
        console.log(response.message)
        if(response.message ==="Email not found"){
            const errorDiv = document.createElement("div");
            errorDiv.innerText = "Email doesn't exist";
            errorDiv.id = "error-password";
            forgot_div.appendChild(errorDiv);
        }else{
            const errorDiv = document.createElement("a");
            errorDiv.innerText = "Forgot your Password?";
            errorDiv.id = "error-password";
            // errorDiv.href = "./forgot_pass.html";
            forgot_div.appendChild(errorDiv);
        }
    }
}

pages.loadFor = (page,data) => {
    eval("pages.page_" + page + "(" + JSON.stringify(data) + ");");
}