window.addEventListener("load", initSite)
document.getElementById("saveBtn").addEventListener("click", saveHoroscope)
document.getElementById("updateBtn").addEventListener("click", updateHoroscope)
document.getElementById("deleteBtn").addEventListener("click", deleteHoroscope)

function initSite() {
    getHoroscope()
}

async function getHoroscope() {
    const inputHoroscope = document.getElementById("showHoroscope")
    const collectedHoroscope = await makeRequest("./API/viewHoroscope.php", "GET")
    console.log(collectedHoroscope) 
    inputHoroscope.innerText = collectedHoroscope
}

async function saveHoroscope() {
    let monthToSave 
    let dayToSave 

    const input = document.getElementById("bdayDate").value
    const date = new Date(input)
    if (!!date.valueOf()) {
        monthToSave = date.getMonth() +1
        dayToSave = date.getDate()
    }
    if (!dayToSave || !monthToSave) {
        console.log("du måste ange din födelsedag")
        return
    }

    const body = new FormData()
    body.set("day", dayToSave)
    body.set("month", monthToSave)

    const collectedHoroscope = await makeRequest("./API/addHoroscope.php", "POST", body)
    console.log(collectedHoroscope) 
    await getHoroscope()
}

async function updateHoroscope() {
    let monthToSave 
    let dayToSave 
    

    const input = document.getElementById("bdayDate").value
    const date = new Date(input)
    if (!!date.valueOf()) {
    monthToSave = date.getMonth() +1
    dayToSave = date.getDate()
    }

    if (!dayToSave || !monthToSave) {
    console.log("du måste välja födelsedatum.")
    return
    }

const body = new FormData()
body.set("day", dayToSave)
body.set("month", monthToSave)

const collectedHoroscope = await makeRequest("./API/updateHoroscope.php", "POST", body)
console.log(collectedHoroscope)

await getHoroscope()
}

async function deleteHoroscope() {
    const collectedHoroscope = await makeRequest("./API/deleteHoroscope.php", "DELETE")
    console.log(collectedHoroscope)
    await getHoroscope()
}

async function makeRequest(path, method, body) {
    try {
        const response = await fetch(path, {
            method,
            body
        })
        console.log(response) 
        return response.json()
    } catch (err) {
        console.error(err)
    }
}
