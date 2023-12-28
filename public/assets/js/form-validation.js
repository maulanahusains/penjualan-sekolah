function slice(str) {
    let sliced = str.split(' ');
    return sliced[0];
}

function removeUnder(str) {
    let splited = str.split('_');
    let firstUpper = splited[0].charAt(0).toUpperCase() + splited[0].slice(1);
    splited.shift();
    splited.unshift(firstUpper);
    if(splited > 1) {
        splited.shift();
        splited.unshift(firstUpper);
    }
    return splited.join(' ');
}

function newError(arr) {
    let a, sliced, errTag;
    arr.forEach(err => {
        sliced = slice(err);

        errMsg = err.split(' ');
        errMsg.shift();
        errMsg.unshift(removeUnder(sliced));

        a = document.getElementById(sliced);

        errTag = document.createElement('p');
        errTag.classList.add('text-danger');
        errTag.textContent = errMsg.join(' ');
        // errTag.textContent = pesan;

        a.parentNode.appendChild(errTag);
        // pesan = '\n';
    });
}

function checklen(e, len) {
    let p = document.getElementById('err-length');
    if(e.value.length > len) {
        return p.style.display = 'inline';
    }
    return p.style.display = 'none';
}

function cekpass() {
    let newpass = document.getElementById("password");
    let verifpass = document.getElementById("new_pass");
    let p = document.getElementById('err-pass');

    if(newpass.value != verifpass.value) {
        return p.style.display = 'inline';
    }

    if(newpass.value == verifpass.value) {
        return p.style.display = 'none';
    }
}
