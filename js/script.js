let divElement1 = document.getElementById("title");
let divElement2 = document.getElementById("desc");

var titleText = document.createTextNode("Заголовок");
var descriptionText = document.createTextNode("Описание");

//Открыть модальное окно
// document.getElementById(params['param0']).addEventListener("click", function() {
//    document.getElementById("my-modal").classList.add("open")
//    divElement1.innerHTML = "<h2>"+titles['title0']+"</h2>"
//    divElement2.innerHTML = "<p>"+descs['desc0']+"</p>" 
// })

document.getElementById("close-my-modal-btn").addEventListener("click", function() {
    document.getElementById("my-modal").classList.remove("open")
})

let index=0;
// for(index=0;index<len;index++){
// document.getElementById(params['param'+index]).addEventListener("click", function() {
//     document.getElementById("my-modal").classList.add("open")
//     divElement1.innerHTML = "<h2>"+titles['title'+index]+"</h2>"
//     divElement2.innerHTML = "<p>"+descs['desc'+index]+"</p>" 
// })}


for(index = 0; index < len; index++) {
    (function(index) {
      document.getElementById(params['param' + index]).addEventListener("click", function() {
        document.getElementById("my-modal").classList.add("open");
        divElement1.innerHTML = "<h2>" + titles['title' + index] + "</h2>";
        divElement2.innerHTML = "<p>" + descs['desc' + index] + "</p>";
      });
    })(index);
}

// Закрыть модальное окно
document.getElementById("close-my-modal-btn").addEventListener("click", function() {
    document.getElementById("my-modal").classList.remove("open")


    var divElement1 = document.getElementById("title");
    var divElement2 = document.getElementById("desc");

    while (divElement1.firstChild) {
        divElement1.removeChild(divElement1.firstChild);
      }
      
      while (divElement2.firstChild) {
        divElement2.removeChild(divElement2.firstChild);
      }
})

// Закрыть модальное окно при нажатии на Esc
window.addEventListener('keydown', (e) => {
    if (e.key === "Escape") {
        document.getElementById("my-modal").classList.remove("open")
    }
});

// Закрыть модальное окно при клике вне его
document.querySelector("#my-modal .modal__box").addEventListener('click', event => {
    event._isClickWithInModal = true;
});
document.getElementById("my-modal").addEventListener('click', event => {
    if (event._isClickWithInModal) return;
    event.currentTarget.classList.remove('open');
});




// document.querySelector('#global_search').oninput = function(){
//     let val = this.value.trim();
//     let elasticItems = document.querySelectorAll('.terms-lines .terms-line');
//     if(val !=''){
//         elasticItems.forEach(function(elem){
//             if(elem.innerText.search(val) == -1){
//                 elem.classList.add('hide');
//             }
//             else{
//                 elem.classList.remove('hide');
//             }
//         });
//     }
//     else{
//         elasticItems.forEach(function(elem){
//             elem.classList.remove('hide');
//         });
//     }
// }


document.querySelector('#global_search').oninput = function() {
    let val = this.value.trim();
    let elasticItems = document.querySelectorAll('.terms-lines .terms-line');
    if(val != ''){
        elasticItems.forEach(function(elem){
            let text = elem.innerText.toLowerCase();
            if(text.search(val.toLowerCase()) == -1){
                elem.classList.add('hide');
            }
            else{
                elem.classList.remove('hide');
            }
        });
    }
    else{
        elasticItems.forEach(function(elem){
            elem.classList.remove('hide');
        });
    }
}

document.getElementById("loop").onclick = function(e) {
    document.getElementById("global_search").value = "";
    let elasticItems = document.querySelectorAll('.terms-lines .terms-line');
    elasticItems.forEach(function(elem){
        elem.classList.remove('hide');
    });
}