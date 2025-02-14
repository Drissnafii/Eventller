document.addEventListener('DOMContentLoaded' ,  ()=>{
    const cards = document.getElementById('cards');
    fetchdata(cards);
})

async function fetchdata(cards){
    const res = await fetch('/statistics' , {
        method : 'GET'
    });
    const data = await res.json();
    console.log(data)
}