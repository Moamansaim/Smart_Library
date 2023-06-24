

/****Create Item***/
function store(url, data) {

    axios.post(url, data)
        .then(function (response) {
            success(response.data)
            document.getElementById('restForm').reset()
            console.log(response);
        })
        .catch(function (error) {
            success(error.response.data)
            console.log(error.response.data);
        });

}

function update(url, data , herf) {

    axios.put(url, data)
        .then(function (response) {

            window.location.href = herf
            console.log(response);
        })
        .catch(function (error) {
            console.log(error.response.data);
        });

}

function updateFormData(url, data , herf) {

    axios.post(url, data)
        .then(function (response) {

            window.location.href = herf
            console.log(response);
        })
        .catch(function (error) {
            console.log(error.response.data);
        });

}


function success(data) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-center',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon:  data.icon,
        title: data.title
    })
}



function deleteItem(url, id, refranses) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            trashItem(url,id,refranses);
        }
    })
}


function trashItem(url, id, refranses) {

    axios.delete(url + id )
        .then(function (response) {
            successDelete(response.data)
            refranses.closest('tr').remove();
            console.log(response);
        })
        .catch(function (error) {
            console.log(error.response.data);
        });

}


function successDelete(data) {

    Swal.fire({
        position: 'center',
        icon: data.icon,
        title: data.title,
        showConfirmButton: false,
        timer: 1500
    })
}






