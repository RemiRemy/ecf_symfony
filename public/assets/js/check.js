


    const listeCheckbox = document.querySelectorAll('.checkboxRole');
    listeCheckbox.forEach(checkbox => {
        checkbox.addEventListener(
            'click', 
            (e) => {
                const id = checkbox.id.substr(5);

                const checked = checkbox.checked ? 1 : 0;

                fetch('/admin/change-role/'+id+'/'+checked)
                .then((resultat) => {

                    if (!resultat.ok) {
                        alert("erreur")
                    } else {
                        alert("fini")
                    }

                });
                
            }
        )
    });
   