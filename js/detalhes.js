document.addEventListener("DOMContentLoaded", function () {
  const decreaseButton = document.getElementById("decrease");
  const increaseButton = document.getElementById("increase");
  const quantidadeInput = document.getElementById("quantidade");

  decreaseButton.addEventListener("click", function () {
      let quantidade = parseInt(quantidadeInput.value);
      if (quantidade > 1) {
          quantidade--;
          quantidadeInput.value = quantidade;
      }
  });

  increaseButton.addEventListener("click", function () {
      let quantidade = parseInt(quantidadeInput.value);
      quantidade++;
      quantidadeInput.value = quantidade;
  });
});

const tabLabels = document.querySelectorAll('.tab-labels span');
        const tabSlides = document.querySelectorAll('.tab-slides .slide');

        tabLabels.forEach((label, index) => {
            label.addEventListener('click', () => {
                // Remove the 'active' class from all labels and slides
                tabLabels.forEach((l) => l.classList.remove('active'));
                tabSlides.forEach((slide) => slide.classList.remove('active'));

                // Add the 'active' class to the clicked label and corresponding slide
                label.classList.add('active');
                tabSlides[index].classList.add('active');
            });
        });