// assets/js/mock.js
// Expose a function to get mock candidates
window.MockAPI = (function(){
  const candidates = [
    { candidate_id: 1, name: "Alice Rivera", party: "Blue Progress", description: "Experienced student leader" },
    { candidate_id: 2, name: "Ben Santos", party: "Green Future", description: "Focus on sustainability" },
    { candidate_id: 3, name: "Cara Lim", party: "Unity Party", description: "Student welfare advocate" }
  ];
  return {
    getCandidates: function(){ return Promise.resolve(candidates); }
  };
})();
