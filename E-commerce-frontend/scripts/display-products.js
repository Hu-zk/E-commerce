// retrieving user data from the local storage

const displayClass = function (dataArray) {
  const cardList = document.getElementById('cardList');

  dataArray.forEach((dataItem) => {
    const liElement = document.createElement('li');

    if(parsedData.role ===0){
      console.log("iam student")
      const page_name = "student"
      liElement.innerHTML = `
      <a href="./${page_name}_stream.html">
      <div class="card-head">
          <div class="text">
            <div class="card-title">
              <h2>${dataItem.title}</h2>
              <span>${dataItem.description}</span>
              </div>
            <span class="card-title">department</span>
            </div>
          <div class="card-icon-container">
            <i class="fa-solid fa-ellipsis-vertical card-menu-icon" style="color: #ffffff;"></i>
          </div>
        </div>
      </a>
      <div class="card-body">
        <div class="due">
          <h4>Due Wednesday</h4>
          <a href="#">10:00 AM - Google_Classroom... </a>
          </div>
        <img src="../assets/user.png" alt="user pic">
      </div>
      <div class="card-footer">
        <div class="card-icon-container">
          <i class="fa-regular fa-id-badge card-footer-icon" style="color: #383838;"></i>
        </div>
        <div class="card-icon-container">
          <i class="fa-regular fa-folder-closed card-footer-icon" style="color: #242424;"></i>
        </div>
      </div>
    `;

    cardList.appendChild(liElement);
    
  }else{
      console.log("iam teacher")
      const page_name = "teacher"
      liElement.innerHTML = `
      <a href="./${page_name}_stream.html">
      <div class="card-head">
          <div class="text">
            <div class="card-title">
              <h2>${dataItem.title}</h2>
              <span>${dataItem.description}</span>
            </div>
            <span class="card-title">department</span>
          </div>
          <div class="card-icon-container">
            <i class="fa-solid fa-ellipsis-vertical card-menu-icon" style="color: #ffffff;"></i>
          </div>
        </div>
      </a>
      <div class="card-body">
        <div class="due">
          <h4>Due Wednesday</h4>
          <a href="#">10:00 AM - Google_Classroom... </a>
        </div>
        <img src="../assets/user.png" alt="user pic">
      </div>
      <div class="card-footer">
        <div class="card-icon-container">
          <i class="fa-regular fa-id-badge card-footer-icon" style="color: #383838;"></i>
        </div>
        <div class="card-icon-container">
          <i class="fa-regular fa-folder-closed card-footer-icon" style="color: #242424;"></i>
        </div>
      </div>
    `;

    cardList.appendChild(liElement);
    }

    
  });
}

const user_data = localStorage.getItem("myData");
const parsedData = JSON.parse(user_data);

if (user_data !== null) {
  console.log('Item exists in local storage!');
  const parsedData = JSON.parse(user_data);
  const class_ = parsedData.classes
  console.log(parsedData)
  displayClass(class_)
} else {
  console.log(user_data)
  console.log('Item does not exist in local storage.');
}

