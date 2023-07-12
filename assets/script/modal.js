    let forms = document.querySelectorAll(".form-delete")
    let myForm
    forms.forEach(form => {
        form.addEventListener("submit", function(e) {
            e.preventDefault();
            myForm = e.target
            openModal()
        })
    });


    function openModal() {
        var modal = document.getElementById("myModal")
        modal.style.display = "block"
    }

    function closeModal() {
        var modal = document.getElementById("myModal")
        modal.style.display = "none"
    }

    function deleteItem() {
        myForm.submit()
        closeModal()
    }
    window.onclick = function(event) {
        var modal = document.getElementById("myModal")
        if (event.target == modal) {
            closeModal()
        }
    }