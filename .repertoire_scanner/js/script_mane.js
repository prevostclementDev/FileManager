/* ########################################################################################################## */
/* ########################################################################################################## */
/* ########################################################################################################## */
/*                                             FONCTION RACCOURCI                                             */
/* ########################################################################################################## */
/* ########################################################################################################## */
/* ########################################################################################################## */
/* RACCOURCI */
/* RETOUR ARRIERE */
let goBackButton = document.querySelector('.goBack');
/* COPY LOCAL ACCES */
let CopyAcces = document.querySelector('.metaAcces');

window.addEventListener('keypress',function(e){

     if ( e.code == "KeyB" && e.shiftKey && goBackButton) {

          window.location.href = goBackButton.getAttribute("href");

     }

     if ( e.code == "KeyC" && e.shiftKey && CopyAcces) {
     
          navigator.clipboard.writeText(CopyAcces.getAttribute("data-acces"));

     }

})

/* ########################################################################################################## */
/* ########################################################################################################## */
/* ########################################################################################################## */
/*                                             FONCTION CLIPBOARD                                             */
/* ########################################################################################################## */
/* ########################################################################################################## */
/* ########################################################################################################## */
let LinkClipBoard = document.querySelectorAll(".LocalClipBoard");

function add_event_clipboard(allClipBoardLink) {

     allClipBoardLink.forEach(e => {
          e.addEventListener('click',copyInClipBoard);
     })

}

function copyInClipBoard(e) {
     navigator.clipboard.writeText(e.target.getAttribute('data-clip'));
}

add_event_clipboard(LinkClipBoard);

/* ########################################################################################################## */
/* ########################################################################################################## */
/* ########################################################################################################## */
/*                                             FONCTION DE RECHERCHE                                          */
/* ########################################################################################################## */
/* ########################################################################################################## */
/* ########################################################################################################## */

/* BASIC SEARCH */
const input = document.querySelector('#search-input-text');

input.addEventListener('input', function(){
    let AllDocument = document.querySelectorAll('.data-search');

    AllDocument.forEach(element => {
            
        const str_search = element.getAttribute('data-file-name').toLowerCase()
        const value_is_contain = str_search.includes(input.value);

        if(value_is_contain) {
    
            element.style.display = "flex";
    
        } else {

            element.style.display = "none";

        }
    
    });

})

/* ADVENCED SEARCH */
const openBtn   =   document.querySelector(".search-input button");
const closeBtn  =   document.querySelector('.content .close a');
const pop_up    =   document.querySelector('.search-pop-up');
const searchBtn =   document.querySelector('#AdvencedSubmit');

/* EVENT BASE */
openBtn.addEventListener('click',function(){
    pop_up.classList.add('active');
});
closeBtn.addEventListener('click',function(){
    pop_up.classList.remove('active');
});
searchBtn.addEventListener('click',function(){

    const searchValue = document.querySelector('#AdvencedName').value;

    ajax_request_researh(searchValue);
    pop_up.classList.remove('active');

});

/* SEARCH REPONSE OF AJAX */
function ajax_request_researh(searchValue){
    const parent = document.querySelector('.parent_ul');
    parent.innerHTML = "chargement...";

    let ajax = new XMLHttpRequest();

    ajax.open(
        "GET",
        '../.repertoire_scanner/function/.repertoire.function.ajaxReturn.php?search_advenced='+searchValue+'&acces=no&acces_serveur=no',
        true
    );

    ajax.onreadystatechange = function() {
        if(ajax.readyState === 4){
            
            const retour = JSON.parse(ajax.response);
            return_traitement(retour,parent);

        }
    }
    ajax.send();

}

/* RETURN VALUE */
function return_traitement(returnFile,parent){
    parent.innerHTML = "";

    for ( var i in  returnFile) {
        const MyObject = returnFile[i];

        let Li = document.createElement('li');

        if( !MyObject.is_file ) {

            Li.classList.add('have_child');
            Li.classList.add('data-search');
            Li.classList.add('reverse');
            Li.setAttribute('data-file-name',MyObject.filename);

            /* LINK 1 */
            let link1 = document.createElement('a');
            link1.setAttribute('href','?acces='+MyObject.acces+'&acces_serveur='+MyObject.serveur_acces);

            let ImgIntoLink = document.createElement('img');
            ImgIntoLink.setAttribute('src',MyObject.icone);

            
            link1.innerText += MyObject.filename;
            link1.appendChild(ImgIntoLink);

            /* LINK 2 */
            let link2 = document.createElement('a');
            link2.classList.add('LocalClipBoard');
            link2.setAttribute('data-clip',MyObject.acces);

            if(MyObject.acces.length > 50) {

                link2.innerText = MyObject.acces.slice(0,50)+"...";

            } else {

                link2.innerText = MyObject.acces;

            }

            Li.appendChild(link1);
            Li.appendChild(link2);

            
        } else {

            Li.classList.add('data-search');
            Li.classList.add('reverse');
            Li.setAttribute('data-file-name',MyObject.filename);

            /* LINK 1 */
            let link1 = document.createElement('a');
            link1.setAttribute('href','?acces='+MyObject.acces+'&acces_serveur='+MyObject.serveur_acces);
            link1.classList.add('file');

            let ImgIntoLink = document.createElement('img');
            ImgIntoLink.setAttribute('src',MyObject.icone);

            
            link1.innerText += MyObject.filename;
            link1.appendChild(ImgIntoLink);

            /* LINK 2 */
            let link2 = document.createElement('a');
            link2.classList.add('LocalClipBoard');
            link2.setAttribute('data-clip',MyObject.acces);
            if(MyObject.acces.length > 50) {

                link2.innerText = MyObject.acces.slice(0,50)+"...";

            } else {

                link2.innerText = MyObject.acces;

            }

            Li.appendChild(link1);
            Li.appendChild(link2);

        }
        parent.appendChild(Li);
    }

    LinkClipBoard = document.querySelectorAll(".LocalClipBoard");
    add_event_clipboard(LinkClipBoard);

}

/* ########################################################################################################## */
/* ########################################################################################################## */
/* ########################################################################################################## */
/*                                             FONCTION PARAMETRE                                             */
/* ########################################################################################################## */
/* ########################################################################################################## */
/* ########################################################################################################## */

const Parametre = document.querySelector('.pop-up-parameter');
const OpenParametre = document.querySelector('.parameterBtn');
const CloseParametre = document.querySelector('.pop-up-parameter .leave');

const ChoiceMenu = document.querySelector('.choise ul');

OpenParametre.addEventListener('click',function(){

    Parametre.style.display = "flex";

})
CloseParametre.addEventListener('click',function(){

    Parametre.style.display = "none";

})

ChoiceMenu.addEventListener('click',function(e){

    if(  ToOpen = e.target.getAttribute('open-zone') ) {

        const LastElement =  document.querySelector('.choise ul li.active');
        LastElement.classList.remove('active');
        
        document.querySelector('.pop-up-parameter .containeur-mid .changeZone .'+LastElement.getAttribute('open-zone')).classList.remove('active');

        e.target.classList.add('active');
        document.querySelector('.pop-up-parameter .containeur-mid .changeZone .'+ToOpen).classList.add('active');

    } 

})

const preferenceSelectAcces = document.querySelector('#preference-select-parameter');
/* SHOW ACCES MENU */
preferenceSelectAcces.addEventListener('change',function(){

    document.querySelector('.pop-up-parameter .acces .acces-element.active').classList.remove('active');
    document.querySelector('.pop-up-parameter .acces .'+preferenceSelectAcces.value).classList.add('active');

})