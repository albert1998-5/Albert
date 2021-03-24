// function sayHi(str = "hi"){
//     console.log(str);
// }
// function stop(){
  
// }


// setInterval(sayHi("aaa"),1000);
// setInterval(sayHi("hi"),1000);
// setInterval(sayHi,1000);

// setInterval(function(){ alert("Hello"); }, 3000);
let student=new Array();
student[0]=["Albert","95","80"];
student[1]=["Ben","82","85"];
student[2]=["Ck","90","92"];
document.write("<table border='1'><tr><td>編號</td><td>姓名</td><td>國文</td><td>英文</td><td>總分</td></tr>");
for(let i=0; i<student.length;i++){
    document.write("<tr><td>"+(Number(i)+1)+"</td>");
    for(let j=0;j<student[i].length;j++){
        document.write("<td>"+student[i][j]+"</td>");   
    }
    for(let j=1;j<student[i].length;j++){
        let a1=Number(student[i][j]);
        let a2=Number(student[i][j+1]);
        let a3=a1+a2;
        
        document.write("<td>"+a3+"</td>");
    } 
    document.write("</tr>");
}
document.write("</table>");