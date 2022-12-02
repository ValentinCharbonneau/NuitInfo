const { SlashCommandBuilder, EmbedBuilder, Embed } = require('discord.js');
const http = require('http2');
const url = "http://192.168.10.104:8000";
const axios = require('axios');
const { randomInt } = require('crypto');
var id = 0;

module.exports = {
	data: new SlashCommandBuilder()
		.setName('temoignage')
		.setDescription('Provides information about the server.')
		.addSubcommand(add =>
			add.setName("add")
				.setDescription("Ajouter un témoignage")
				.addStringOption(option =>
					option.setName('mst')
						.setDescription('Quel MST ou IST')
						.setRequired(true)
						.addChoices(
							{ name: 'Sida', value: 'Sida' },
							{ name: 'Hépatite B', value: 'Hépatite B' },
							{ name: 'Herpès', value: 'Herpès' },
							{ name: 'Syphilis', value: 'Syphilis' },
							{ name: 'Mycose vaginale', value: 'Mycose vaginale' },
							{ name: 'Gonorrhée (chaude-pisse)', value: 'Gonorrhée (chaude-pisse)' },
							{ name: 'Papillomavirus', value: 'Papillomavirus' },
						))
				.addStringOption(option =>
					option.setName('prenom')
						.setDescription('Votre prénom?')
						.setRequired(true))
				.addIntegerOption(option =>
					option.setName('age')
						.setDescription('Quel est votre âge ?')
						.setRequired(true))
				.addStringOption(option =>
					option.setName('content')
						.setDescription('Racontez votre histoire.')
						.setRequired(true)))
		.addSubcommand(view =>
			view.setName("view")
				.setDescription("Voir un témoignage aléatoire.")
				.addStringOption(mst =>
					mst.setName('mst_name')
						.setDescription("Chosissez la MST dont vous voulez voir un témoignage aléatoire.")
						.setChoices(
							{ name: 'Sida', value: 'Sida' },
							{ name: 'Hépatite B', value: 'Hépatite B' },
							{ name: 'Herpès', value: 'Herpès' },
							{ name: 'Syphilis', value: 'Syphilis' },
							{ name: 'Mycose vaginale', value: 'Mycose vaginale' },
							{ name: 'Gonorrhée (chaude-pisse)', value: 'Gonorrhée (chaude-pisse)' },
							{ name: 'Papillomavirus', value: 'Papillomavirus' },
						)
						.setRequired(true))),

	async execute(interaction) {
		if (interaction.options.getSubcommand() === "add") {
			axios.post(`${url}/api/testimony`, {
				name: interaction.options.getString("prenom"),
				age: interaction.options.getInteger("age"),
				MST: interaction.options.getString("mst"),
				content: interaction.options.getString("content")
			})
				.then(function (response) {
					console.log(response);
				})
				.catch(function (error) {
					console.log(error);
				});
			await interaction.reply({ content: `Votre témoignage a bien été pris en compte.`, ephemeral: true });
		}
		if (interaction.options.getSubcommand() === "view") {
			let embed = new EmbedBuilder()
			axios.get(encodeURI(`${url}/api/testimony`)).then(response => {
				let list = [];
				for (let element of response.data) {
					if (element.MST == interaction.options.getString("mst_name")) {
						list.push(element)
					}
				}

				id = list[randomInt(0, list.length)];


			}).then(resp => {
				axios.get(encodeURI(`${url}/api/testimony/${id.id}`)).then(r => {

					var embed = new EmbedBuilder()
						.setAuthor({ name: `Témoignage sur : ${r.data.MST}` })
						.setImage("https://i0.wp.com/www.coalitionplus.org/wp-content/uploads/2021/09/V2B-BANNIERE-FB-851X315-HD-scaled.jpg")
						.setThumbnail("https://pvsq.org/wp-content/uploads/2019/08/finalPlan-de-travail-4.png").addFields(
							{ name: "Individu", value: `${r.data.name}  ${r.data.age}ans` },
							{ name: "Témoignage", value: r.data.content }

						)
					interaction.reply({ embeds: [embed] })

				})
			})


		}
	},
};