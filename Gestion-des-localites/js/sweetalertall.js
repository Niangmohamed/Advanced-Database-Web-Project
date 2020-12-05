function sweetalert() {
  var test1 = document.forme.region.value ;
  var test3 = document.forme.commune.value ;
  var test5 = document.forme.cercle.value ;

  if(test1 != '' && test5 != '' && test3 != ''){
  Swal.fire({
  title: 'Etes vous sur?',
  text: "Vous ne pouvez pas revenir en arrière!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Oui, enregistré!'
}).then((result) => {
  if (result.value) {
    Swal.fire(
      'Enregistré!',
      'Le questionnaire est bien envoyé.',
      'succés'
    )
  }
})
}
}


function sweetalert2() {
Swal.fire({
  type: 'erreur',
  title: 'Oops...',
  text: 'Veuillez télécharger un fichier de donnée svp.!',
})
}


function sweetalert2_2() {
Swal.fire({
  type: 'erreur',
  title: 'Oops...',
  text: 'Le fichier de donnée a été importé avec succés.!',
})
}

function sweetalert3() {
Swal.fire({
  position: 'top-end',
  type: 'success',
  title: 'La vue agent est exportée avec succés',
  showConfirmButton: false,
  timer: 1500
})
}

function sweetalert4() {

  var test1 = document.formtest.num_equipe.value ;
  var test5 = document.formtest.role.value ;

  if(test1 != '' && test5 != ''){
  Swal.fire({
  title: 'Equipe crée avec succés',
  animation: false,
  customClass: 'animated tada'
})}
}