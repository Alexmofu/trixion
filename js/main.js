/* Ready */
$(document).ready(function () {

  /****************/
  /* LATERAL MENU */
  /****************/

  /* Mobile Hamburger */
  $(".navbartop").on('click', (e) => {
    $(".wrapperlittle").toggleClass("wrapperactive");
    $("body").toggleClass("contentscrollhide");
  })

  /* window replace for every navbarlink to avoid browser history spam*/
  $("#home").on('click', (e) => {
    window.location.replace("http://www.trixion.net");
  })

  $("#guildplanner").on('click', (e) => {
    window.location.replace("http://www.trixion.net/guildplanner");
  })

  $("#support").on('click', (e) => {
    window.location.replace("http://www.trixion.net/support");
  })

  $("#supportAbout").on('click', (e) => {
    window.location.replace("http://www.trixion.net/support");
  })

  $("#account").on('click', (e) => {
    window.location.replace("http://www.trixion.net/account");
  })

  $("#about").on('click', (e) => {
    window.location.replace("http://www.trixion.net/about");
  })

}); //Document Ready end


/*******************************************/
/*                  ACCOUNT                */
/*******************************************/

/**     SIGNUP AND LOGIN     **/

$("#openSignup").on('click', (e) => {
  $(".accountLogin").hide();
  $(".accountSignup").show("fade", "linear", "slow");

})

$("#closeSignup").on('click', (e) => {
  $(".accountSignup").hide();
  $(".accountLogin").show("fade", "linear", "slow");
})

$("#loginform").on('submit', (e) => {
  e.preventDefault();
  $.ajax({
    url: 'https://www.trixion.net/php/backend/includes/Login.inc.php',
    type: 'POST',
    data: $("#loginform").serialize(),
    success: function (res) {
      if (res == "success") {
        setTimeout(function () {
          location.reload();
        }, 500)
      } else {
        $("#loginerror").text(res);
        $("#loginform").trigger("reset");
      }
    }
  })
})

$("#signupform").on('submit', (e) => {
  e.preventDefault();
  $.ajax({
    url: 'https://www.trixion.net/php/backend/includes/Signup.inc.php',
    type: 'POST',
    data: $("#signupform").serialize(),
    success: function (res) {
      if (res == "success") {
        //SUCCESSFULLY REGISTER
        window.location.replace("http://www.trixion.net/account");
      } else {
        $("#signuperror").text(res);
        $("#signupform").trigger("reset");
      }
    }
  })
})


$('form[name="accountmanagementform"]').on('submit', (e) => {
  e.preventDefault();
  let data = $('form[name="accountmanagementform"]').serialize();

  $.ajax({
    url: 'https://www.trixion.net/php/backend/includes/ChangeUserData.inc.php',
    type: 'POST',
    data: data,
    success: function (res) {
      if (res == "success") {
        $(".userError").css("color", "var(--color-green)");
        $(".userError").text(res);
        $(".userError").css("display", "block");
        $(".userError").delay(5000).queue(function () {
          $(".userError").css("display", "none");
          $.dequeue(this);
        })
        $('form[name="accountmanagementform"]').trigger('reset');
      } else {
        //error handler
        $(".userError").css("color", "var(--color-red)");
        $(".userError").text(res);
        $(".userError").css("display", "block");
        $(".userError").delay(5000).queue(function () {
          $(".userError").css("display", "none");
          $.dequeue(this);
        })
      }
    }
  })
})



/**     GUILD    **/

$("#newGuild").on('submit', (e) => {
  e.preventDefault();
  $.ajax({
    url: 'https://www.trixion.net/php/backend/includes/NewGuild.inc.php',
    type: 'POST',
    data: $("#newGuild").serialize(),
    success: function (res) {
      if (res == "success") {
        window.location.replace("http://www.trixion.net/account");
      } else {
        //ERROR HANDLER INFORMATION TO THE END USER
        $("#guildError").css("color", "var(--color-red)");
        $("#guildError").text(res);
        $("#guildError").css("display", "block");
        $("#guildError").delay(5000).queue(function () {
          $("#guildError").css("display", "none");
          $.dequeue(this);
        })
      }
    }
  })
})


$("#joinGuild").on('submit', (e) => {
  e.preventDefault();
  $.ajax({
    url: 'https://www.trixion.net/php/backend/includes/JoinGuild.inc.php',
    type: 'POST',
    data: $("#joinGuild").serialize(),
    success: function (res) {
      if (res == "success") {
        window.location.replace("http://www.trixion.net/account");
      } else {
        //ERROR HANDLER INFORMATION TO THE END USER
        $("#guildError").css("color", "var(--color-red)");
        $("#guildError").text(res);
        $("#guildError").css("display", "block");
        $("#guildError").delay(5000).queue(function () {
          $("#guildError").css("display", "none");
          $.dequeue(this);
        })
      }
    }
  })
})


$("#leaveGuild").on('submit', (e) => {
  e.preventDefault();
  $.ajax({
    url: 'https://www.trixion.net/php/backend/includes/LeaveGuild.inc.php',
    type: 'POST',
    success: function (res) {
      if (res == "success") {
        window.location.replace("http://www.trixion.net/account");
      } else {
        //ERROR HANDLER INFORMATION TO THE END USER
        $("#guildError").css("color", "var(--color-red)");
        $("#guildError").text(res);
        $("#guildError").css("display", "block");
        $("#guildError").delay(5000).queue(function () {
          $("#guildError").css("display", "none");
          $.dequeue(this);
        })
      }
    }
  })
})


$("#disbandGuild").on('submit', (e) => {
  e.preventDefault();
  $.ajax({
    url: 'https://www.trixion.net/php/backend/includes/DisbandGuild.inc.php',
    type: 'POST',
    success: function (res) {
      if (res == "success") {
        window.location.replace("http://www.trixion.net/account");
      } else {
        //ERROR HANDLER INFORMATION TO THE END USER
        $("#guildError").css("color", "var(--color-red)");
        $("#guildError").text(res);
        $("#guildError").css("display", "block");
        $("#guildError").delay(3000).queue(function () {
          $("#guildError").css("display", "none");
          $.dequeue(this);
        })
      }
    }
  })
})


$("#guildSecret").on('click', (e) => {
  clipboardText = $(e.target).val();
  navigator.clipboard.writeText(clipboardText);
  $("#guildError").css("color", "var(--color-green)");
  $("#guildError").text("Code copied to clipboard");
  $("#guildError").css("display", "block");
  $("#guildError").delay(3000).queue(function () {
    $("#guildError").css("display", "none");
    $.dequeue(this);
  })
})
/**     KICK USER FROM GUILD    **/

$(".memberKick").on('click', (e) => {
  e.preventDefault();
  let data = {};
  data['memberName'] = $(e.target).parent().parent().find("div[name='memberName']").text();

  $.ajax({
    url: 'https://www.trixion.net/php/backend/includes/KickGuildMember.inc.php',
    type: 'POST',
    data: data,
    success: function (res) {
      if (res == "success") {
        $(e.target).parents(".guildMemberLi").remove();
      } else {
        //UserFeedback error msg
      }
    }
  })
})

/**     CHANGE GUILD USER ROLE   **/

$('.memberRole').on('change', (e) => {
  e.preventDefault();
  let data = {};
  data['memberName'] = $(e.target).parent().parent().find("div[name='memberName']").text();
  data['userRole'] = $(e.target).parent().parent().find("select[name='userRole']").val()
  $.ajax({
    url: 'https://www.trixion.net/php/backend/includes/ChangeGuildRole.inc.php',
    type: 'POST',
    data: data,
    success: function (res) {
      if (res == "success") {
        //success feedback
        /* console.log(res);  */
      } else {
        //UserFeedback error msg
        /* console.log(res); */
      }
    }
  })
});

/**     SEARCH BAR GUILD MANAGER   **/

$(".guildManagerSearch").on('keyup', (e) => {
  let filter = $(e.target).val(),
    count = 0;

  $('.guildMemberLi').each(function (ev) {
    if ($(this).text().search(new RegExp(filter, "i")) < 0) {
      $(this).hide("fade", {
      }, 200);
    } else {
      $(this).show("fade", {
      }, 200);
      count++;
    }
  })
})

/**     NEW CHARACTER    **/

$("#newCharacterForm").on('submit', (e) => {
  e.preventDefault();
  $.ajax({
    url: 'https://www.trixion.net/php/backend/includes/NewCharacter.inc.php',
    type: 'POST',
    data: $("#newCharacterForm").serialize(),
    success: function (res) {
      let response = res.replaceAll('"', '');
      if (response > 0 || Number.isInteger(response)) {
        /* Store Values */
        let name = $("#newCharacterForm").find("input[name=characterName]").val();
        let selectedClass = $(".classSelect").first().val();
        console.log(selectedClass);
        let ilvl = $("#newCharacterForm").find("input[name=characterIlvl]").val();

        /* GENERATE NEW CHARACTER TEMPORARY */
        $("#newCharacterForm").parent("ul").append("<form class='characterForm'><span class='characterError'></span><li class='CharacterDetailOpen'>ejemplo</li><div class='deleteCharacter'></div><div class='characterDetails'><input type='hidden' class='characterId' name='characterId' value=''><div class='charnameEdit'><span>Name</span><br><input type='text' maxlength='16' name='characterName' class='accountformInput' placeholder='Name' value=''></div><div class='classEdit'><span>Class</span><br class='nextClone'></div><div class='ilvlEdit'><span>Item Level</span><br><input type='number' maxlength='4' min='0' pattern='[0-9]*' inputmode='numeric' name='characterIlvl' class='accountformInput' placeholder='Ilvl' value=''></div><div></div><div class='sendEdit'><button name='submit' class='accountbtn'>Save</button></div></div></form> ");
        /* ADD TEMPORARY VALUES FROM THE PREVIOUS FORM */
        $("#newCharacterForm").parent("ul").last("form").find(".CharacterDetailOpen").last().text(name);
        $("#newCharacterForm").parent("ul").last("form").find("input[name=characterId]").last().val(response);
        $("#newCharacterForm").parent("ul").last("form").find("input[name=characterName]").last().val(name);
        $("#newCharacterForm").parent("ul").last("form").find("input[name=characterIlvl]").last().val(ilvl);
        $(".classSelect").first().clone().appendTo($("#newCharacterForm").parent("ul").last("form").find(".nextClone").last().prev());
        $("#newCharacterForm").parent("ul").last("form").find("select[name=characterClass]").last().val(selectedClass);


        $(".CharacterDetailOpen").last().get(0).scrollIntoView({ behavior: 'smooth' });
        $("#newCharacterForm").trigger("reset");
      } else {
        $(e.target).find(".characterError").css("color", "red");
        $(e.target).find(".characterError").text(res);
        $(e.target).find(".characterError").css("display", "block");
        $(e.target).find(".characterError").delay(3000).queue(function () {
          $(e.target).find(".characterError").css("display", "none");
          $.dequeue(this);
        })
      }
    }
  })
})




/**     EDIT CHARACTER    **/

$("body").on('submit', '.characterForm', (e) => {
  e.preventDefault();
  $.ajax({
    url: 'https://www.trixion.net/php/backend/includes/EditCharacter.inc.php',
    type: 'POST',
    data: $(e.target).serialize(),
    success: function (res) {
      if (res == "success") {
        characterName = $(e.target).find("input[name=characterName]").val();
        $(e.target).find(".CharacterDetailOpen").text(characterName);
        $(e.target).find(".characterError").css("color", "var(--color-green)");
        $(e.target).find(".characterError").css("display", "block");
        $(e.target).find(".characterError").text("Succesfully Modified");
        $(e.target).find(".characterError").delay(3000).queue(function () {
          $(e.target).find(".characterError").css("display", "none");
          $.dequeue(this);
        })
      } else if (res == "Not you character Id, nice try.") {
        window.location.href = "https://www.youtube.com/watch?v=dQw4w9WgXcQ";
      } else {
        $(e.target).find(".characterError").css("color", "red");
        $(e.target).find(".characterError").text(res);
        $(e.target).find(".characterError").css("display", "block");
        $(e.target).find(".characterError").delay(3000).queue(function () {
          $(e.target).find(".characterError").css("display", "none");
          $.dequeue(this);
        })
      }
    }
  })
})

/**     DELETE CHARACTER    **/

$("body").on("click", ".deleteCharacter", (e) => {
  e.preventDefault();
  let data = {};
  data['characterId'] = ($(e.target).next().find(".characterId").val());


  $.ajax({
    url: 'https://www.trixion.net/php/backend/includes/DeleteCharacter.inc.php',
    type: 'POST',
    data: data,
    success: function (res) {
      if (res == "success") {
        $(e.target).parents(".characterForm").remove();

      } else {
        console.log(res);
        $(e.target).find(".characterError").css("color", "red");
        $(e.target).find(".characterError").text(res);
      }
    }
  })
})


/* OPEN AND CLOSE EDIT CHARACTER FORM */
$("body").on('click', ".CharacterDetailOpen", (e) => {
  $(".CharacterDetailOpen").removeClass("charSelected");
  if ($(".characterDetails").hasClass("characterEditing")) {
    $(".characterDetails").removeClass("characterEditing");
    $("#addAccountCharacter").removeClass("charSelected");
  }
  if ($("#addAccountCharacter").hasClass("characterEditing")) {
    $("#addAccountCharacter").removeClass("characterEditing");
    $("#addAccountCharacter").removeClass("charSelected");
  }

  $(e.target).toggleClass("charSelected");
  $(e.target).next(".deleteCharacter").next(".characterDetails").toggleClass("characterEditing");
  $(e.target).get(0).scrollIntoView({ behavior: 'smooth' });

})

/* OPEN AND CLOSE NEW CHARACTER FORM */
$("#addAccountCharacter").on('click', (e) => {
  $(".CharacterDetailOpen ").removeClass("charSelected");
  if ($(".characterDetails").hasClass("characterEditing")) {
    $(".characterDetails").removeClass("characterEditing");
  }

  $(e.target).addClass("charSelected");
  $(e.target).next(".characterDetails").toggleClass("characterEditing");
  $(e.target).get(0).scrollIntoView({ behavior: 'smooth' });

})

/*******************************************/
/*              Guild Planner              */
/*******************************************/

$('.guildEvent').on('click', (e) => {
  document.body.style.overflow = 'hidden';
  $(e.target).parents(".eventWrapper").find(".guildEventModal").toggleClass('eventModalActive');
});

$('.guildEventModal').on('click', (e) => {
  if ($(e.target).hasClass('eventModalActive')) {
    document.body.style.overflow = 'initial';
    $(e.target).toggleClass('eventModalActive');
  }
});

$(document).on('keyup', function (e) {
  if (e.key == "Escape") {
    $(".guildEventModal").removeClass("eventModalActive");
    $(".characterPickerModal").removeClass("characterPickerModalActive");
    $(".newEventModal").removeClass("eventModalActive");
    document.body.style.overflow = 'initial';
  };
});

$('.guildEventModalClose').on('click', (e) => {
  $(".guildEventModal").removeClass("eventModalActive");
  document.body.style.overflow = 'initial';
});

$('.characterPickerModalClose').on('click', (e) => {
  $(".characterPickerModal").removeClass("characterPickerModalActive");
  document.body.style.overflow = 'initial';
});

$('.characterPickerModal').on('click', (e) => {
  if ($(e.target).hasClass('characterPickerModalActive')) {
    document.body.style.overflow = 'initial';
    $(e.target).toggleClass('characterPickerModalActive');
  }
});

$("body").on('click', ".guildEventCharacter", (e) => {
  /* if(e.target !=  "guildEventCharacterName") */
  $(e.target).parents('.guildEventCharacter').find('.guildEventCharacterName').toggle("fast", "linear", 200);
  $(e.target).parents('.guildEventCharacter').find('.guildEventCharacterDetails').toggle("fast", "linear", 200);
})

$('.guildEventModalContent-Button').on('click', (e) => {
  globalThis.selectedEventId = $(e.target).parents('.guildEventModal').find('input[name=EventId]').val();
  $('.characterPickerModal').toggleClass('characterPickerModalActive');
})

$('.guildEventModalContent-ButtonLeave_Active').on('click', (e) => {
  globalThis.selectedEventId = $(e.target).parents('.guildEventModal').find('input[name=EventId]').val();
})


/* Character Join event */
$('.characterPicker-Char').on('click', (e) => {
  let joinCharacterId = $(e.target).closest(".characterPicker-Char").find('input[name="characterPicker-Char-Id"]').val();
  let joinCharacterName = $(e.target).closest(".characterPicker-Char").find('.characterPicker-CharName').text();
  let joinCharacterIlvl = $(e.target).closest(".characterPicker-Char").find('input[name="characterPicker-Ilvl"]').val();
  let joinCharacterClass = $(e.target).closest(".characterPicker-Char").find('input[name="characterPicker-ClassName"]').val();

  let data = {};
  data['joinCharacterId'] = joinCharacterId;
  data['joinCharacterName'] = joinCharacterName;
  data['joinCharacterIlvl'] = joinCharacterIlvl;
  data['joinCharacterClass'] = joinCharacterClass;
  data['joinSelectedEventId'] = selectedEventId;

  /* AJAX HERE */
  $.ajax({
    url: 'https://www.trixion.net/php/backend/includes/JoinGuildEvent.inc.php',
    type: 'POST',
    data: data,
    success: function (res) {
      if (res == "success" || res == "\r\nsuccess") {
        $(".characterPickerModal").removeClass('characterPickerModalActive');
        $('.eventModalActive').find(".guildEventCharacters").append('<li class="guildEventCharacter guildEventCharacterOwn"><div class="guildEventCharacterName">' + joinCharacterName + ' </div><div class="guildEventCharacterDetails">' + joinCharacterClass + ' - ' + joinCharacterIlvl + '</div></li>');
        let currentPlayers = $('.eventModalActive').find('.guildEventModalCurrentParticipants').text();
        currentPlayers = parseInt(currentPlayers);
        let newCurrentPlayers = currentPlayers + 1;
        $('.eventModalActive').find('.guildEventModalCurrentParticipants').text(newCurrentPlayers);
        $('.eventModalActive').find('.guildEventModalContent-Button').toggleClass('guildEventModalContent-Button_Disabled');
        $('.eventModalActive').find('.guildEventModalContent-Button').hide();
        $('.eventModalActive').find('.guildEventModalContent-ButtonLeave').toggleClass("guildEventModalContent-ButtonLeave_Active");
        $('.guildEvent').find('input[name="guildEventId"][value=' + selectedEventId + ']').parents(".guildEvent").find('.guildEventStatusCurrent').text(newCurrentPlayers);
      } else {
        console.log(res);
      }
    }
  })
})


$("body").on('click', ".guildEventModalContent-ButtonLeave_Active", (e) => {
  let data = {};
  data['joinSelectedEventId'] = selectedEventId;

  $.ajax({
    url: 'https://www.trixion.net/php/backend/includes/LeaveGuildEvent.inc.php',
    type: 'POST',
    data: data,
    success: function (res) {
      if (res == "success") {
        $('.eventModalActive').find('.guildEventCharacterOwn').remove();
        let currentPlayers = $('.eventModalActive').find('.guildEventModalCurrentParticipants').text();
        currentPlayers = parseInt(currentPlayers);
        let newCurrentPlayers = currentPlayers - 1;
        $('.eventModalActive').find('.guildEventModalCurrentParticipants').text(newCurrentPlayers);
        $('.eventModalActive').find('.guildEventModalContent-ButtonLeave').removeClass("guildEventModalContent-ButtonLeave_Active");
        $('.eventModalActive').find('.guildEventModalContent-Button').removeClass("guildEventModalContent-Button_Disabled");
        $('.eventModalActive').find('.guildEventModalContent-Button').show();
        $('.guildEvent').find('input[name="guildEventId"][value=' + selectedEventId + ']').parents(".guildEvent").find('.guildEventStatusCurrent').text(newCurrentPlayers);

      } else {
        //Error Handler
        console.log(res);
      }
    }
  })
})



$("body").on('click', ".guildEventKickUser", (e) => {
  let selectedEventIdKick = $(e.target).parents('.guildEventModal').find('input[name=EventId]').val();
  let currentPlayers = $('.eventModalActive').find('.guildEventModalCurrentParticipants').text();
  currentPlayers = parseInt(currentPlayers);
  let newCurrentPlayers = currentPlayers - 1;
  let kickCharacterId = $(e.target).parents('.guildEventCharacter').find('input[name=id_character]').val();

  let data = {};
  data['eventId'] = selectedEventIdKick;
  data['characterId'] = kickCharacterId;

  $.ajax({
    url: 'https://www.trixion.net/php/backend/includes/KickUserGuildEvent.inc.php',
    type: 'POST',
    data: data,
    success: function (res) {
      if (res == "success") {
        $(e.target).parents('.guildEventCharacter').remove();
        $('.eventModalActive').find('.guildEventModalCurrentParticipants').text(newCurrentPlayers);
        $('.guildEvent').find('input[name="guildEventId"][value=' + selectedEventIdKick + ']').parents(".guildEvent").find('.guildEventStatusCurrent').text(newCurrentPlayers);
      } else {
        //Error handler
        console.log(res);
      }
    }
  })
})




$("body").on('click', ".eventModalDelete", (e) => {
  let data = {};
  let selectedEventIdDelete = $(e.target).parents('.guildEventModal').find('input[name=EventId]').val();
  data['eventId'] = selectedEventIdDelete;


  $.ajax({
    url: 'https://www.trixion.net/php/backend/includes/DeleteGuildEvent.inc.php',
    type: 'POST',
    data: data,
    success: function (res) {
      if (res == "success") {
        $('.guildEvent').find('input[name="guildEventId"][value=' + selectedEventIdDelete + ']').parents(".eventWrapper").remove();
        $('.eventModalActive').remove();
        document.body.style.overflow = 'initial';
      } else {
        console.log(res);
      }
    }
  })

})

$('#addbtnBtn').on('click', (e) => {
  $('.addbtn-btn-sm').toggleClass('scale-out');
});

$('.newEventModalClose').on('click', (e) => {
  $(".newEventModal").removeClass("eventModalActive");
  document.body.style.overflow = 'initial';
});

$('.newEventModal').on('click', (e) => {
  if ($(e.target).hasClass('eventModalActive')) {
    document.body.style.overflow = 'initial';
    $(e.target).toggleClass('eventModalActive');
  }
});

$(".addbtn-btn-raid").on('click', (e) => {
  $('.newEventModal').addClass('eventModalActive');
  $('.newEventModal').find('select[name="newEventType"]').val("Raid").change();
  $('.newEventModal').find('input[name="newEventColor"]').val("#914C63");
  $('.newEventModal').find('input[name="newEventMaxPlayers"]').val("8");
  document.body.style.overflow = 'hidden';
})


$(".addbtn-btn-abyss").on('click', (e) => {
  $('.newEventModal').addClass('eventModalActive');
  $('.newEventModal').find('select[name="newEventType"]').val("Abyssal Dungeon").change();
  $('.newEventModal').find('input[name="newEventColor"]').val("#608a24");
  $('.newEventModal').find('input[name="newEventMaxPlayers"]').val("4");
  document.body.style.overflow = 'hidden';
})


$(".addbtn-btn-pvp").on('click', (e) => {
  $('.newEventModal').addClass('eventModalActive');
  $('.newEventModal').find('select[name="newEventType"]').val("PvP").change();
  $('.newEventModal').find('input[name="newEventColor"]').val("#482F4A");
  document.body.style.overflow = 'hidden';
})


$(".addbtn-btn-others").on('click', (e) => {
  $('.newEventModal').addClass('eventModalActive');
  $('.newEventModal').find('select[name="newEventType"]').val("Others").change();
  $('.newEventModal').find('input[name="newEventColor"]').val("#EFF0FA");
  document.body.style.overflow = 'hidden';
})

$(".newEventGenerateButton").on('click', (e) => {
  let formData = $('#newEvent').serialize();
  $.ajax({
    url: 'https://www.trixion.net/php/backend/includes/AddGuildEvent.inc.php',
    type: 'POST',
    data: formData,
    success: function (res) {
      if (containsNumber(res) == true) {
        location.reload(); //Easier to do cause no time left
      } else {
        console.log(res);
      }
    }
  })


})

function containsNumber(str) {
  return /\d/.test(str);
}


/* SUPPORT FORM */


$("#supportsendbtn").on('click', (e) => {
  let data = $("#supportForm").serialize();

  $.ajax({
    url: 'https://www.trixion.net/php/backend/includes/SupportFormSend.inc.php',
    type: 'POST',
    data: data,
    success: function (res) {
      if (res == "success") {
        //Success Message
        $('#supportForm').trigger("reset");
        $("#supportformFeedback").css("color", "var(--color-green)");
        $("#supportformFeedback").css("display", "block");
        $("#supportformFeedback").text("Success");
        $("#supportformFeedback").delay(3000).queue(function () {
          $("#supportformFeedback").css("display", "none");
          $.dequeue(this);
        })
      } else {
        $("#supportformFeedback").css("color", "var(--color-red)");
        $("#supportformFeedback").css("display", "block");
        $("#supportformFeedback").text(res);
        $("#supportformFeedback").delay(20000).queue(function () {
          $("#supportformFeedback").css("display", "none");
          $.dequeue(this);
        })
      }
    }
  })
})