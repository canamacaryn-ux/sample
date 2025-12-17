const announcements = [
  {title:"Seminar on AI", date:"2025-12-10", description:"Join our AI seminar for students and professionals."},
  {title:"Coding Competition", date:"2025-12-15", description:"Participate and win exciting prizes!"},
  {title:"Workshop on Web Development", date:"2025-12-20", description:"Hands-on training on HTML, CSS, JS."}
];
const container=document.getElementById("announcements-list");
const searchBox=document.getElementById("searchBox");

function displayAnnouncements(data){
  container.innerHTML="";
  data.forEach(item=>{
    const div=document.createElement("div");
    div.classList.add("announcement");
    div.innerHTML=`<h3>${item.title}</h3><p><strong>Date:</strong> ${item.date}</p><p>${item.description}</p>`;
    container.appendChild(div);
  });
}
displayAnnouncements(announcements);

searchBox.addEventListener("input", function(){
  const searchTerm=this.value.toLowerCase();
  const filtered=announcements.filter(item=>item.title.toLowerCase().includes(searchTerm) || item.description.toLowerCase().includes(searchTerm));
  displayAnnouncements(filtered);
});
