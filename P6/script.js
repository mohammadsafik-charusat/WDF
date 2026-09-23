let students = [];

let currentPage = 1;

const recordsPerPage = 5;


// ==========================
// FETCH JSON DATA
// ==========================

fetch("students.json")

    .then(response => response.json())

    .then(data => {

        students = data;

        document.getElementById("loading").style.display = "none";

        displayStudents(students);

    })

    .catch(error => {

        document.getElementById("loading").style.display = "none";

        document.getElementById("error").textContent =
            "Unable to load student data.";

        console.log(error);

    });


// ==========================
// DISPLAY STUDENTS
// ==========================

function displayStudents(data) {

    const table = document.getElementById("studentTable");

    table.innerHTML = "";


    const start = (currentPage - 1) * recordsPerPage;

    const end = start + recordsPerPage;

    const pageData = data.slice(start, end);


    pageData.forEach(student => {

        const row = `
            <tr>
                <td>${student.id}</td>
                <td>${student.name}</td>
                <td>${student.email}</td>
                <td>${student.course}</td>
                <td>${student.year}</td>
            </tr>
        `;

        table.innerHTML += row;

    });


    document.getElementById("pageNumber").textContent =
        "Page " + currentPage;

}


// ==========================
// SEARCH
// ==========================

const search = document.getElementById("search");


search.addEventListener("input", function () {

    const searchText = search.value.toLowerCase();


    const result = students.filter(student =>

        student.name.toLowerCase().includes(searchText)

    );


    currentPage = 1;

    displayStudents(result);

});


// ==========================
// COURSE FILTER
// ==========================

const courseFilter = document.getElementById("courseFilter");


courseFilter.addEventListener("change", function () {

    const selectedCourse = courseFilter.value;


    if (selectedCourse === "all") {

        currentPage = 1;

        displayStudents(students);

        return;

    }


    const result = students.filter(student =>

        student.course === selectedCourse

    );


    currentPage = 1;

    displayStudents(result);

});


// ==========================
// SORTING
// ==========================

const sort = document.getElementById("sort");


sort.addEventListener("change", function () {

    let result = [...students];


    if (sort.value === "az") {

        result.sort((a, b) =>

            a.name.localeCompare(b.name)

        );

    }


    if (sort.value === "za") {

        result.sort((a, b) =>

            b.name.localeCompare(a.name)

        );

    }


    currentPage = 1;

    displayStudents(result);

});


// ==========================
// PREVIOUS BUTTON
// ==========================

document.getElementById("prev").addEventListener("click", function () {

    if (currentPage > 1) {

        currentPage--;

        displayStudents(students);

    }

});


// ==========================
// NEXT BUTTON
// ==========================

document.getElementById("next").addEventListener("click", function () {

    const totalPages = Math.ceil(

        students.length / recordsPerPage

    );


    if (currentPage < totalPages) {

        currentPage++;

        displayStudents(students);

    }

});