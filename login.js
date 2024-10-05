document.querySelector('form').addEventListener('submit', function (event) {
    event.preventDefault(); 

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;


    if (!email || !password) {
        alert("Please fill in all fields.");
        return;
    }
 

    const formData = new FormData(this);


    fetch('login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {

        document.body.innerHTML += data; 
    })
    .catch(error => console.error('Error:', error));
});