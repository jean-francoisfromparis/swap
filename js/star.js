const allStars = document.querySelectorAll(`.fa-star`);
const rating = document.querySelector(`.rating`);

init();

function init()
{
    allStars.forEach(star =>{
        star.addEventListener(`click`, saveRating);
        star.addEventListener(`mouseover`, addGold);
        star.addEventListener(`mouseleave`, removeGold);
        
    })
}
function saveRating(e) { 
    removeEventListnerToAllStars();
    rating.innerHTML = e.target.dataset.star;

    
}
function removeEventListnerToAllStars()
{   allStars.forEach(star =>{
    star.removeEventListener(`click`     , saveRating);
    star.removeEventListener(`mouseover` , addGold);
    star.removeEventListener(`mouseleave`, removeGold);
    


    });
}
function addGold(e, css="checked"){
    const overedStar =e.target;
    overedStar.classList.add(css);
    const previousSiblings = getPreviousSiblings(overedStar);
    console.log(`previousSiblings`,previousSiblings);
    previousSiblings.forEach(elem=> elem.classList.add(css));
    
}
function removeGold(e, css="checked"){
    const overedStar =e.target;
    e.target.classList.remove(css);
    const previousSiblings = getPreviousSiblings(overedStar);
    previousSiblings.forEach(elem=> elem.classList.remove(css));
}
function getPreviousSiblings(elem){
    console.log("elem.previousSibling", elem.previousSibling);
    let siblings = [];
    const spanNodeType = 1;
    while(elem = elem.previousSibling){
        if(elem.nodeType === spanNodeType){
            siblings = [elem, ...siblings];
        }
    }
    return siblings;
}