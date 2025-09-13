function sendEmail() {
  Email.send({
      SecureToken: '6b29ee6b-5cd6-4e43-87c1-a42ace7e5a02',
      To: 'floritsiaa@gmail.com',
      From: 'floritsiaa@gmail.com',
      Subject: "New Contact Form",
      Body: "Name: " + document.getElementById("nameform").value
          + "<br>Email: " + document.getElementById("emailform").value
          + "<br>Message: " + document.getElementById("messageform").value
  }).then(messageDisplay);
}

function messageDisplay() {
  const modal = document.getElementById('sendSuccessMsg');
  const closeButton = document.getElementById('Msgclosebutton');
  const modalOkButton = document.getElementById('MsgOkButton');
  
  // Function to open the modal
  function openModal() {
      modal.style.display = 'block';
  }
  
  // Function to close the modal
  function closeModal() {
      modal.style.display = 'none';
  }

  // Open the modal
  openModal();

  // Event listeners
  closeButton.addEventListener('click', closeModal);
  modalOkButton.addEventListener('click', closeModal);

  // Close modal if the user clicks outside the modal content
  window.addEventListener('click', function(event) {
      if (event.target === modal) {
          closeModal();
      }
  });
}
