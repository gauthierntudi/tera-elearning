function quiz_pusher(newQuestionaires,method){
	if(!newQuestionaires || !method){
		throw Error("Should provide a newQuestionaire and a method arguments");
	}

	let successMessage = (method == 'POST')? 'Le questionnaire a été ajoutée':'Le questionnaire a été modifié',
	emptyError = "Erreur sans message",
	errorOperation = (method == 'post')? "Une erreur est survenue lors de l'ajout du questionnaire":"Une erreur est survenue lors de la modification du questionnaire";

	return fetch('/php/quiz',{
		method:method,
		headers:{
			'content-type':'application/json'
		},
		body: JSON.stringify({...newQuestionaires, formationId:__formationId})
	}).then((response)=>{
		let status = response.status,
		payload;

		if(status == 201){
			alert(successMessage);

			return true;
		}
		else if(status == 400){
			return response.json().then((payload)=>{
				if(payload.error){
					if(payload.error.message){
						alert(payload.error.message);
					}
					else{
						alert(emptyError);
					}
				}
				else{
					response.text((text)=>{
						console.error("serveur message",text);
					}).finally(()=>{
						alert(errorOperation);
					})
				}
			}).catch((error)=>{
				console.error("Error parsing json",error);
				response.text((text)=>{
					console.error("Using text instead",text);
				}).catch((error)=>{
					console.error("Big error",error);
					alert(errorOperation);
				})
			}).finally(()=>{
				return false;
			})
		}
		else{
			console.error("Unknwon status",status);

			return false;
		}
	}).catch((error)=>{
		console.error(error);
		alert(errorOperation);
		return false;
	})
}


function showQuizForm(event){
	event.preventDefault();

	let target = event.target,
	other = document.getElementById('mainCont'),
	action = target.getAttribute('data-action'),
	addVideo = document.getElementById('addVideo');

	console.log("QUIZZI",action);

	if(action){
		switch(action){
		case 'quiz-add':
			try{
				let quiz = document.getElementById('quiz'),
				payload = {
					onSave:function(newQuestionaires){
						payload.loading = true;

						Quiz.updateForm(root,payload);

						quiz_pusher(newQuestionaires,'POST').then((success)=>{
							if(success){
								other.style.display = '';
								root.unmount();
								location.reload();
							}
							else{
								payload.loading = false;

								Quiz.updateForm(root, payload);
								iziToast.error({
									title:"Echec d'ajout",
									message:"L'ajout du questionnaire n'a pas pu être effectué"
								});
							}
						}).catch((error)=>{
							payload.loading = false;

							Quiz.updateForm(root, payload);

							iziToast.error({
								title:'Erreur',
								message:"Une erreur est survenue lors de l'ajout du questionaire. Veuillez réesayer"
							})
						})
					},
					onClose:()=>{
						root.unmount();

						other.style.display = '';
					},
					onError:(errors)=>{
						for(let id in errors){
							iziToast.error({
								title:'Erreur',
								message: errors[id]
							})
						}
					}
				},
				root;

				root = Quiz.renderForm(quiz,payload)

				other.style.display = 'none';
			}
			catch(error){
				console.error("Oupus",error);
			}
			break;
		case 'quiz-edit':
			if(__questions && __questions instanceof Array){
				let quiz = document.getElementById('quiz'),
				payload = {
					questions: __questions.concat(),
					title: __quiz_title,
					onSave: function(newQuestionaires){
						payload.loading = true;

						Quiz.updateForm(root, payload)

						quiz_pusher(newQuestionaires,'PUT').then((success)=>{
							console.log("success",success);
							if(success){
								location.reload();
								other.style.display = '';
								root.unmount();
							}
							else{
								payload.loading = false;

								Quiz.updateForm(root,payload);
							}
						}).catch((error)=>{
							payload.loading = false;
							Quiz.updateForm(root,payload);

							iziToast({
								title:"Erreur",
								message:"Une erreur est survenue lors de la modification du quiz. Veuillez réesayer"
							})
						});
					},
					onClose: function(){
						root.unmount();
						other.style.display = ''
					},
					onError: function(errors){
						for(let id in errors){
							iziToast.error({
								title:'Erreur',
								message: errors[id]
							})
						}
					}
				},
				root = Quiz.renderForm(quiz, payload);

				other.style.display = 'none';
			}
			else{
				alert("Invalid questions");
			}
			break;
		case 'play-quiz':
			if(__questions && __questions instanceof Array){
				let quiz = document.getElementById('quiz'),
				root = Quiz.renderQuiz(quiz, {
					questionaire:{
						questions: __questions.concat()
					},
					onResultat:function(pourcentage){
						fetch('/php/evaluation.php',{
							method:'POST',
							headers:{
								'content-type':'application/json'
							},
							body: JSON.stringify({
								formationId: __formationId,
								pourcentage:pourcentage
							})
						}).then((response)=>{
							let status = response.status;

							if(status >= 400){
								try{
									let payload = JSON.parse(response.json());
									console.error("Server evaluation repsonse",payload);
								}
								catch(error){
									console.error("Error parsing data",error);
									response.text((console.log)).catch(console.error);
								}
							}
							else{
								hasResult = true;
							}
						}).catch((error)=>{
							console.error("Error while sending evaluation",error);
						})
					},
					onBack:function(){
						root.unmount();
						other.style.display = '';

						if(hasResult){
							location.reload();
						}
					}
				}),
				hasResult;

				other.style.display = 'none';
			}
			break;
		case 'video-add':
			addVideo.className = addVideo.className.replace('d-none');
			other.style.display = 'none';
			break;
		default:
			alert("Unknwon action "+ action);
		}
	}
}