class Roulette {
  constructor(options, settings) {
    this.options = options;
    this.speed = settings.speed || 2;
    this.duration = settings.duration || 5;
    this.stopImageNumber = settings.stopImageNumber;
    this.stopCallback = settings.stopCallback;
    this.images = [];

    for (let i = 0; i < options.length; i++) {
      this.images.push(`<img src="../uploads/roulette.jfif" alt="${options[i]}">`);
    }

    this.render();
  }

  render() {
    const rouletteEl = document.getElementById('roulette');
    rouletteEl.innerHTML = '';

    for (let i = 0; i < this.images.length; i++) {
      const imgEl = document.createElement('div');
      imgEl.innerHTML = this.images[i];
      imgEl.classList.add('roulette-image');
      rouletteEl.appendChild(imgEl);
    }
  }

  start() {
    const rouletteEl = document.getElementById('roulette');
    const imagesCount = this.images.length;

    let currentImageIndex = 0;
    let intervalId = setInterval(() => {
      rouletteEl.children[currentImageIndex].classList.remove('active');
      currentImageIndex = (currentImageIndex + 1) % imagesCount;
      rouletteEl.children[currentImageIndex].classList.add('active');
    }, this.speed * 1000);

    setTimeout(() => {
      clearInterval(intervalId);
      rouletteEl.children[currentImageIndex].classList.remove('active');

      if (this.stopImageNumber !== null) {
        currentImageIndex = this.stopImageNumber % imagesCount;
      } else {
        currentImageIndex = Math.floor(Math.random() * imagesCount);
      }

      rouletteEl.children[currentImageIndex].classList.add('active');

      if (typeof this.stopCallback === 'function') {
        this.stopCallback(currentImageIndex);
      }
    }, this.duration * 1000);
  }
}

const options = [
  '{{ bonus.nomBonus1 }}',
  '{{ bonus.nomBonus2 }}',
  '{{ bonus.nomBonus3 }}',
  '{{ bonus.nomBonus4 }}'
];

const roulette = new Roulette(options, {
  speed: 3,
  duration: 3,
  stopImageNumber: null,
  stopCallback: function(index) {
    console.log(`Roulette stopped on image number ${index + 1}`);
  }
});

document.getElementById('start').addEventListener('click', function() {
  roulette.start();
});
