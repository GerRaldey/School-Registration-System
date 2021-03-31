let updateBtn = document.getElementById('update-btn');
let updateForm = document.getElementById('updateForm');

let displayupdateform = false;

updateBtn.onclick = function(){
	if(displayupdateform==false){
		updateForm.style.display = 'block';
		displayupdateform = true;
	}else{
	   updateForm.style.display = 'none';	
       displayupdateform = false;
	}
}