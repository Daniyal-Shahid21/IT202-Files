function breedResult() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200) {
      document.getElementById("breed").textContent = xhr.responseText;
    }
  };
  var breedType = document.getElementById("input").value;
  xhr.open("GET", "dogBreed.php?dogBreed=" + encodeURIComponent(breedType), true);
  xhr.send();
}