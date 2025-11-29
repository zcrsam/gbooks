<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Oedipus Rex — Interactive Archive</title>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&family=Cormorant+Garamond:wght@300;400&display=swap" rel="stylesheet">

<style>
/* GENERAL STYLING */
* { margin:0; padding:0; box-sizing:border-box; }
body {
  font-family: 'Cormorant Garamond', serif;
  background: linear-gradient(to bottom, #1b1a27, #232430);
  color: #e6e4df;
  overflow-x: hidden;
}
a { text-decoration:none; color:#d4af37; }
a:hover { color:#fff; }

h1,h2,h3,h4 { font-family:'Cinzel Decorative', serif; color:#d4af37; }
header { text-align:center; padding:50px 20px; }
h1 { font-size:clamp(3rem,6vw,5rem); }
h2 { font-size:2.5rem; margin-top:10px; }

.content-container { max-width:1000px; margin:auto; padding:100px 20px 20px; }

/* TIMELINE */
.timeline { display:flex; justify-content:space-between; margin-top: -80px; margin-bottom: 40px; position:relative; }
.timeline::before { content:''; position:absolute; top:50%; left:5%; right:5%; height:4px; background:#d4af37; z-index:0; border-radius:2px; }
.timeline-point { z-index:1; text-align:center; cursor:pointer; }
.timeline-point:hover h4 { color:#fff; transform:scale(1.1); }
.timeline-point h4 { transition:0.3s; }

/* CHARACTER CARDS */
.character-container { display:flex; flex-wrap:wrap; gap:20px; justify-content:center; }
.character-card { background:#2a2a34; padding:20px; border-radius:15px; box-shadow:0 10px 25px rgba(0,0,0,0.5); width:200px; transition:transform 0.3s; cursor:pointer; }
.character-card:hover { transform:translateY(-10px) scale(1.05); }
.character-card img { width:100%; border-radius:10px; margin-bottom:10px; }
.character-card p { font-size:0.9rem; }

/* QUOTES / MODAL CONTENT */
.quote { background: rgba(212,175,55,0.1); border-left:4px solid #d4af37; margin:20px 0; padding:15px 20px; font-style:italic; }
.quote:hover { background: rgba(212,175,55,0.3); transform:scale(1.02); transition:0.3s; }

/* BACK BUTTON */
.back-btn { position: fixed; top:20px; left:20px; padding:10px 20px; border:2px solid #d4af37; border-radius:6px; color:#d4af37; background:transparent; z-index:1000; transition:0.3s; }
.back-btn:hover { background:#d4af37; color:#232430; }

/* ANALYSIS CONTAINER */
.analysis-container { background:#2a2a34; padding:20px; border-radius:15px; box-shadow:0 10px 25px rgba(0,0,0,0.5); text-align:justify; }
.analysis-container .analysis-text { font-size:1rem; line-height:1.6; }

/* AUTHOR CARD */
.author-card {
  background:#2a2a34;
  padding:15px;
  border-radius:15px;
  box-shadow:0 10px 25px rgba(0,0,0,0.5);
  text-align:center;
  width:250px;
  margin:30px auto;
}
.author-card h4 {
  color:#d4af37;
  margin-bottom:10px;
}

/* PLAY GAME SECTION */
#play-game { margin-top:30px; padding:20px; background:#2a2a34; border-radius:15px; box-shadow:0 10px 25px rgba(0,0,0,0.5); }
#play-game h3 { margin-bottom:15px; text-align:center; }
#play-game button { margin:5px; padding:10px 15px; border:2px solid #d4af37; background:transparent; color:#d4af37; border-radius:5px; cursor:pointer; transition:0.3s; }
#play-game button:hover { background:#d4af37; color:#232430; }

/* MODAL */
.modal { 
  display:none; 
  position:fixed; 
  z-index:2000; 
  left:0; top:0; 
  width:100%; height:100%; 
  background-color:rgba(0,0,0,0.7); 
  align-items:center; 
  justify-content:center;
}
.modal.show { display:flex; }
.modal-content { 
  background-color:#2a2a34; 
  padding:20px; 
  border:2px solid #d4af37; 
  width:90%; max-width:600px; 
  border-radius:15px; 
  box-shadow:0 10px 25px rgba(0,0,0,0.5); 
  text-align:center;
}
.modal-content button { margin:5px; padding:10px 15px; border:2px solid #d4af37; background:transparent; color:#d4af37; border-radius:5px; cursor:pointer; transition:0.3s; }
.modal-content button:hover { background:#d4af37; color:#232430; }
.modal-close { float:right; font-size:1.5rem; cursor:pointer; color:#d4af37; }

section { opacity:0; transform:translateY(30px); transition: all 0.8s ease-in-out; margin-bottom:50px; }
section.visible { opacity:1; transform:translateY(0); }
</style>
</head>
<body>
<a href="{{ url('/#projects') }}" class="back-btn">← Back</a>

<header><h1>Oedipus Rex</h1>
<p style="font-style:italic;">“I know you are sick to death, all of you, but sick as you are, not one is as sick as I”</p>
</header>

<div class="content-container">

  <div class="timeline">
    <div class="timeline-point" onclick="showTimelineEvent('Heroic Age')"><h4>Heroic Age</h4></div>
    <div class="timeline-point" onclick="showTimelineEvent('Greek Era')"><h4>Greek Era</h4></div>
    <div class="timeline-point" onclick="showTimelineEvent('Roman Era')"><h4>Roman Era</h4></div>
    <div class="timeline-point" onclick="showTimelineEvent('Patristic')"><h4>Patristic</h4></div>
  </div>

  <section>
    <h3>Summary</h3>
    <p>Thebes is suffering from a deadly plague, and King Oedipus pledges to end the suffering by finding the murderer of the former king, Laius. He consults the oracle at Delphi through his brother-in-law Creon, and the message comes back: the plague will only lift when Laius’s killer is punished. Oedipus aggressively pursues the truth, summoning the blind prophet Tiresias, who eventually reveals that Oedipus himself is the murderer. Furious, Oedipus accuses others and digs deeper, even as his wife Jocasta angrily urges him to stop believing in prophecies.</p>
    <p>As the investigation continues, Oedipus learns from a messenger and a shepherd that he was adopted and that his real parents are Jocasta and Laius — which means he has fulfilled the prophecy: he killed his father and married his mother. Horrified, Jocasta kills herself, and Oedipus blinds himself with her brooches. In his final act, he asks Creon to exile him and to care for his daughters, and he accepts the terrible truth of his fate, showing how even a great king cannot outrun prophecy.</p>
  </section>

  <section>
    <h3>Main Characters</h3>
    <div class="character-container">
      <div class="character-card">
        <img src="/images/oedipus.jpg" alt="Oedipus">
        <p><strong>Oedipus:</strong> King of Thebes, determined to find the truth about King Laius’ murder, and ultimately discovers that he himself is the killer.</p>
      </div>
      <div class="character-card">
        <img src="/images/jocasta.jpg" alt="Oedipus">
        <p><strong>Jocasta:</strong> Oedipus’ wife and mother, who tries to stop him from discovering the truth and ends her life when the truth is revealed.</p>
      </div>
      <div class="character-card">
        <img src="/images/creon.jpg" alt="Oedipus">
        <p><strong>Creon:</strong> Oedipus’ brother-in-law and wise advisor who brings messages from the oracle and tries to maintain order.</p>
      </div>
      <div class="character-card">
        <img src="/images/tiresias.jpg" alt="Oedipus">
        <p><strong>Tiresias:</strong> The blind prophet who knows the truth about Oedipus and reluctantly reveals it, warning him of the consequences.</p>
      </div>
    </div>
  </section>

  <section>
    <h3>About the Author</h3>
    <div class="author-card">
      <h4>Homer</h4>
      <p>Homer is known as the ancient Greek poet traditionally believed to have written <em>The Iliad</em> and <em>The Odyssey</em>. His works shaped Greek culture, influenced later literature, and continue to be studied today for their storytelling and themes about heroism, honor, and human emotion.</p>
    </div>
  </section>

  <section id="play-game">
    <h3>Interactive Games</h3>
    <div style="text-align:center;">
      <button id="playYes">Play Now</button>
    </div>
  </section>

</div>

<!-- MODAL -->
<div id="gameModal" class="modal" aria-hidden="true">
  <div class="modal-content" role="dialog" aria-modal="true" aria-labelledby="gameTitle">
    <div id="gameContent"></div>
  </div>
</div>

<script>
// Scroll animation
const sections = document.querySelectorAll('section');
function revealSections() {
  sections.forEach(sec => {
    const top = sec.getBoundingClientRect().top;
    if(top < window.innerHeight - 100) sec.classList.add('visible');
  });
}
revealSections();
window.addEventListener('scroll', revealSections);

// Modal setup
const modal = document.getElementById('gameModal');
const gameContent = document.getElementById('gameContent');
document.getElementById('playYes').onclick = openGameOptions;

modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });

function openGameOptions() {
  modal.classList.add('show');
  modal.setAttribute('aria-hidden','false');
  showActivityOptions();
}
function closeModal() {
  modal.classList.remove('show');
  modal.setAttribute('aria-hidden','true');
}

function showActivityOptions() {
  gameContent.innerHTML = `
    <span class="modal-close" id="closeModalBtn">&times;</span>
    <h3>Select a Game</h3>
    <div>
      <button id="game1Btn">Who Would You Be?</button>
      <button id="game2Btn">Theme Hunt</button>
      <button id="game3Btn">What Happens Next</button>
    </div>
  `;
  document.getElementById('closeModalBtn').onclick = closeModal;
  document.getElementById('game1Btn').onclick = startGame1;
  document.getElementById('game2Btn').onclick = startGame2;
  document.getElementById('game3Btn').onclick = startGame3;
}

// Game 1: Who Would You Be
function startGame1() {
  gameContent.innerHTML = `
    <span class="modal-close" id="closeModalBtn">&times;</span>
    <h3>Who Would You Be?</h3>
    <p>Imagine you are Oedipus, Jocasta, or Tiresias during a key moment in the story. What would you do?</p>
    <div>
      <button onclick="alert('You chose to search for the truth no matter what!')">Search for the truth</button>
      <button onclick="alert('You chose to ignore the prophecy!')">Ignore prophecy</button>
      <button onclick="alert('You chose to warn others or hide the truth!')">Warn or hide the truth</button>
    </div>
    <button onclick="showActivityOptions()">Back to Games</button>
  `;
  document.getElementById('closeModalBtn').onclick = closeModal;
}

// Game 2: Theme Hunt
function startGame2() {
  gameContent.innerHTML = `
    <span class="modal-close" id="closeModalBtn">&times;</span>
    <h3>Theme Hunt</h3>
    <p>"Oedipus tore the brooches from Jocasta’s robe and blinded himself, grief and horror overwhelming him."</p>
    <p>Which theme is shown here?</p>
    <div>
      <button onclick="alert('Fate, Pride, and Consequences')">Fate / Pride / Consequences</button>
      <button onclick="alert('Humility')">Humility</button>
    </div>
    <button onclick="showActivityOptions()">Back to Games</button>
  `;
  document.getElementById('closeModalBtn').onclick = closeModal;
}

// Game 3: What Happens Next
function startGame3() {
  gameContent.innerHTML = `
    <span class="modal-close" id="closeModalBtn">&times;</span>
    <h3>What Happens Next?</h3>
    <p>You see Tiresias warning Oedipus that he is the cause of Thebes’ suffering. What do you think happens next?</p>
    <div>
      <button onclick="alert('Oedipus listens and accepts the truth')">Oedipus listens</button>
      <button onclick="alert('Oedipus refuses to believe him and accuses others')">Oedipus accuses others</button>
      <button onclick="alert('Oedipus leaves Thebes immediately')">Oedipus leaves</button>
    </div>
    <button onclick="showActivityOptions()">Back to Games</button>
  `;
  document.getElementById('closeModalBtn').onclick = closeModal;
}

function showTimelineEvent(period){
  gameContent.innerHTML = `
    <span class="modal-close" id="closeModalBtn">&times;</span>
    <h3>Period: ${period}</h3>
    <p>Learn more about historical context and Greek tragedies here.</p>
  `;
  document.getElementById('closeModalBtn').onclick = closeModal;
}
</script>

</body>
</html>
