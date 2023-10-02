var equation = "";
var arr = []
var screen = document.getElementById("screen")
function display(put){
    document.getElementById("screen").value += put;
}
function calculate(){
    equation = document.getElementById("screen").value
    try{
        answer = eval(document.getElementById("screen").value)
        document.getElementById("screen").value = answer;
        try{
            arr.push(equation + ' = ' +answer);
        }
        catch (err){
            console.log(err);
        }
    }
    catch(err){
        document.getElementById("screen").value = "Wrong equtaion";
    }
}
function clearScreen(){
    if (screen.value != ""){
        screen.value = "";
    }
}
function clearAll(){
    screen.value = "";
    arr.length = 0;
    document.getElementById("his").removeChild(h3)
}
function showEquation(){
    if (equation != ""){
        document.getElementById("screen").value = equation;
    }
    else{
        screen.value = "No equation";
    }
}
function showHistory(){
    try{
        var parentDiv = document.getElementById("his");
        var newDiv = document.createElement("h3");
        newDiv.innerText = "Latest History";
        parentDiv.appendChild(newDiv);
        for (i = 0;i<(arr.length);i++){
            var newDiv = document.createElement("p");
            var num = i + 1;
            newDiv.innerText = "Equation no. "+ num + " : " + arr[i];
            console.log(newDiv.innerText)
            var parentDiv = document.getElementById("his");
            parent.appendChild(newDiv);
        }
    }
    catch(err){
        console.log(err)
    }
}