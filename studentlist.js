document.addEventListener('DOMContentLoaded',async () => {
    const studentsTableBody = document.getElementById('studentsTable1');

    // Function to fetch and display students
    function fetchStudents() {
        fetch('/students')
            .then(response => response.json())
            .then(students => {
                studentsTableBody.innerHTML = '';
                students.forEach(student => {
                    studentsTableBody.innerHTML = `
                     <tr>
                        <td>${student.studentid}</td>
                        <td>${student.name}</td>
                        <td>${student.roll}</td>
                        <td>${student.session}</td>
                        <td>${student.mobile}</td>
                        <td>
                            <button onclick="editStudent(${student.studentid})">Edit</button>
                            <button onclick="deleteStudent(${student.studentid})">Delete</button>
                        </td>
                     </tr>                        
                    `;
                    
                });
            })
            .catch(err => console.error('Error fetching students:', err));
    }window.onload = loadBooks;

    // Function to edit a student
    window.editStudent = function (studentId) {
        // Implementation for editing a student
        // Fetch the student details, show in a form, and allow updates
    };

    // Function to delete a student
    window.deleteStudent = function (studentId) {
        fetch(`/delete-student/${studentId}`, { method: 'DELETE' })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    fetchStudents();
                } else {
                    console.error('Error deleting student:', result);
                }
            });
    };

    // Fetch and display students on page load
    fetchStudents();
});
