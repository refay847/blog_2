<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>I Love You Soso 💕</title>
  <style>
    /* Romantic, soft & elegant */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      min-height: 100vh;
      background: radial-gradient(circle at 20% 30%, #ffe6f0, #ffc2d9, #ffa5c3);
      background-attachment: fixed;
      font-family: 'Segoe UI', 'Quicksand', system-ui, -apple-system, sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      position: relative;
    }

    /* floating hearts layer */
    .hearts {
      position: absolute;
      inset: 0;
      pointer-events: none;
      overflow: hidden;
      z-index: 1;
    }

    .heart-float {
      position: absolute;
      color: rgba(255, 255, 255, 0.7);
      font-size: 1.6rem;
      user-select: none;
      animation: floatUp 8s infinite ease-in-out;
      filter: drop-shadow(0 0 6px rgba(255, 80, 120, 0.4));
    }

    @keyframes floatUp {
      0% {
        transform: translateY(0) scale(0.8) rotate(0deg);
        opacity: 0.2;
      }
      50% {
        transform: translateY(-40vh) scale(1.2) rotate(15deg);
        opacity: 0.9;
      }
      100% {
        transform: translateY(-80vh) scale(0.7) rotate(30deg);
        opacity: 0;
      }
    }

    /* main card – soft, glassy, romantic */
    .love-card {
      position: relative;
      z-index: 10;
      background: rgba(255, 245, 250, 0.75);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border-radius: 60px 60px 60px 60px;
      padding: 3rem 4.5rem;
      box-shadow: 0 25px 45px -10px rgba(200, 50, 100, 0.3),
                  0 0 0 2px rgba(255, 255, 255, 0.5) inset,
                  0 0 40px rgba(255, 120, 160, 0.4);
      border: 1px solid rgba(255, 220, 235, 0.9);
      text-align: center;
      animation: gentlePulse 3s infinite alternate;
      transition: all 0.3s;
      max-width: 90vw;
    }

    @keyframes gentlePulse {
      0% {
        transform: scale(1);
        box-shadow: 0 25px 45px -10px rgba(200, 50, 100, 0.3),
                    0 0 0 2px rgba(255, 255, 255, 0.5) inset,
                    0 0 40px rgba(255, 120, 160, 0.4);
      }
      100% {
        transform: scale(1.02);
        box-shadow: 0 30px 55px -8px rgba(220, 70, 120, 0.5),
                    0 0 0 3px rgba(255, 240, 245, 0.8) inset,
                    0 0 60px rgba(255, 140, 180, 0.7);
      }
    }

    /* the big three words */
    .love-message {
      font-size: clamp(3rem, 12vw, 6rem);
      font-weight: 700;
      letter-spacing: 0.05em;
      color: #b3005e;
      text-shadow: 2px 2px 0 #ffb6d9, 4px 4px 8px rgba(190, 40, 100, 0.2);
      line-height: 1.2;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 0.2em;
      font-family: 'Quicksand', 'Segoe UI', sans-serif;
    }

    /* individual word spans for extra animation */
    .word {
      display: inline-block;
      animation: bounceIn 0.9s cubic-bezier(0.18, 0.89, 0.32, 1.28) forwards;
      opacity: 0;
      transform: scale(0.8);
    }

    .word:nth-child(1) { animation-delay: 0.1s; }
    .word:nth-child(2) { animation-delay: 0.4s; }
    .word:nth-child(3) { animation-delay: 0.7s; }

    @keyframes bounceIn {
      0% {
        opacity: 0;
        transform: scale(0.3) translateY(30px);
      }
      70% {
        opacity: 1;
        transform: scale(1.1) translateY(-5px);
      }
      100% {
        opacity: 1;
        transform: scale(1) translateY(0);
      }
    }

    /* special styling for "soso" – extra lovely */
    .soso-love {
      color: #d4006e;
      background: linear-gradient(145deg, #ffd9e8, #ffb3cf);
      -webkit-background-clip: text;
      background-clip: text;
      -webkit-text-fill-color: transparent;
      text-shadow: none;
      position: relative;
      display: inline-block;
      padding: 0 0.1em;
    }

    /* subtle heart underline */
    .soso-love::after {
      content: '❤';
      position: absolute;
      bottom: -0.4em;
      left: 50%;
      transform: translateX(-50%);
      font-size: 0.4em;
      color: #ff4d6d;
      opacity: 0.8;
      filter: drop-shadow(0 0 6px #ff99bb);
      animation: tinyHeart 1.8s infinite;
    }

    @keyframes tinyHeart {
      0%, 100% { transform: translateX(-50%) scale(1); opacity: 0.7; }
      50% { transform: translateX(-50%) scale(1.3); opacity: 1; }
    }

    /* small signature line */
    .signature {
      margin-top: 2rem;
      font-size: 1.2rem;
      color: #a13d63;
      letter-spacing: 0.2em;
      font-style: italic;
      font-weight: 400;
      text-transform: uppercase;
      background: linear-gradient(to right, transparent, #ffb0c8, transparent);
      padding: 0.6rem 0;
      border-radius: 50px;
      opacity: 0.9;
      animation: fadeInGlow 3s infinite alternate;
    }

    @keyframes fadeInGlow {
      0% { opacity: 0.7; text-shadow: 0 0 5px #ffb0c8; }
      100% { opacity: 1; text-shadow: 0 0 20px #ff7fa8, 0 0 30px #ffb0c8; }
    }

    /* additional floating decorations – little stars / sparkles */
    .sparkle {
      position: absolute;
      z-index: 5;
      color: #fff0f5;
      font-size: 2rem;
      text-shadow: 0 0 12px #ff9ec0;
      animation: twinkle 2.4s infinite alternate;
      pointer-events: none;
    }

    @keyframes twinkle {
      0% { opacity: 0.2; transform: scale(0.8) rotate(0deg); }
      100% { opacity: 1; transform: scale(1.3) rotate(10deg); }
    }

    /* responsive fine-tuning */
    @media (max-width: 480px) {
      .love-card {
        padding: 2rem 1.5rem;
        border-radius: 40px;
      }
      .love-message {
        font-size: clamp(2.5rem, 15vw, 4rem);
        gap: 0.1em;
      }
      .signature {
        font-size: 0.9rem;
        letter-spacing: 0.15em;
      }
    }
  </style>
</head>
<body>
  <!-- floating hearts generated via JS, but also a couple static for no-JS -->
  <div class="hearts" id="heartsContainer">
    <!-- fallback hearts (will be enhanced by JS) -->
    <span class="heart-float" style="left: 5%; top: 10%; animation-duration: 9s;">❤️</span>
    <span class="heart-float" style="left: 85%; top: 20%; animation-duration: 12s;">❤️</span>
    <span class="heart-float" style="left: 45%; top: 80%; animation-duration: 7s;">❤️</span>
    <span class="heart-float" style="left: 70%; top: 65%; animation-duration: 10s;">❤️</span>
    <span class="heart-float" style="left: 15%; top: 70%; animation-duration: 11s;">❤️</span>
  </div>

  <!-- sparkles (decorative) -->
  <span class="sparkle" style="top: 12%; left: 18%; animation-delay: 0.3s;">✨</span>
  <span class="sparkle" style="top: 78%; left: 82%; animation-delay: 1.2s;">✨</span>
  <span class="sparkle" style="top: 40%; left: 8%; animation-delay: 0.9s; font-size: 1.6rem;">✨</span>
  <span class="sparkle" style="top: 20%; left: 90%; animation-delay: 0.1s; font-size: 2.2rem;">✨</span>
  <span class="sparkle" style="top: 88%; left: 10%; animation-delay: 1.8s;">✨</span>

  <!-- main romantic card -->
  <div class="love-card">
    <div class="love-message">
      <span class="word">I</span>
      <span class="word">Love</span>
      <span class="word">Soso</span>
    </div>
    <div class="signature">💖 forever & always 💖</div>
  </div>

  <script>
    (function() {
      // ----- create extra floating hearts dynamically -----
      const heartsContainer = document.getElementById('heartsContainer');
      if (heartsContainer) {
        const heartSymbols = ['❤️', '💖', '💗', '💓', '💕', '🌸', '💘', '💝'];
        const heartCount = 22;

        for (let i = 0; i < heartCount; i++) {
          const heart = document.createElement('span');
          heart.className = 'heart-float';
          // random symbol
          heart.textContent = heartSymbols[Math.floor(Math.random() * heartSymbols.length)];
          // random left position (0-100%)
          const left = Math.random() * 100;
          // random size between 1rem and 2.8rem
          const size = 1 + Math.random() * 1.8;
          // random animation duration between 7s and 16s
          const duration = 7 + Math.random() * 9;
          // random delay (negative to start immediately at different phases)
          const delay = Math.random() * -20;
          // random opacity base
          const opacity = 0.3 + Math.random() * 0.6;

          heart.style.left = left + '%';
          heart.style.top = (Math.random() * 100) + '%';
          heart.style.fontSize = size + 'rem';
          heart.style.animationDuration = duration + 's';
          heart.style.animationDelay = delay + 's';
          heart.style.opacity = opacity;
          // ensure it sits behind card but above bg
          heart.style.zIndex = 2;

          heartsContainer.appendChild(heart);
        }
      }

      // ----- small extra: make the soso word pulse subtly -----
      // (already has heart underline, but we can add a little js-free sparkle)
      // no further JS needed, but we can add a click to spread more hearts? optional.
      // Keep it pure and romantic, no interaction required.
    })();
  </script>

  <!-- subtle overlay to soften edges (optional) -->
  <div style="position: fixed; inset: 0; pointer-events: none; background: radial-gradient(circle at 50% 50%, transparent 40%, rgba(255,200,220,0.15) 90%); z-index: 15;"></div>
</body>
</html>