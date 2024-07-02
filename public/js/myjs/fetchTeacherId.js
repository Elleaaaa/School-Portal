document.getElementById('subjectTeacher').addEventListener('change', function() {
    var selectedTeacherId = this.value;
    var selectedTeacherName = this.options[this.selectedIndex].getAttribute('data-name');
    
    var teacherIdInput = document.getElementById('teacherId');
    var teacherNameInput = document.getElementById('teacherName');
    
    // Set the hidden input values to the selected teacher's ID and name
    teacherIdInput.value = selectedTeacherId;
    teacherNameInput.value = selectedTeacherName;
});