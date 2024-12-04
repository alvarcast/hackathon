function copyToClipBoard(button) {
    // Copy the text inside the text field
    navigator.clipboard.writeText(button.innerText);
  
    // Alert the copied text
    alert("Copied to your clipboard!");
}