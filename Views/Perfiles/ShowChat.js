
const btn = 
document.querySelector("#btn");


const dlg = 
document.querySelector("#dlg");

const btn2 = 
document.querySelector("#btn2");
const btn3 = 
document.querySelector("#btn3"); 




btn2.addEventListener("click",()=>{

    dlg.close();
    
    })



btn.addEventListener("click",()=>{

            dlg.showModal();
            
            })
        btn3.addEventListener("click",()=>{

            window.alert("Lista creada");

            dlg.close();
            
            })