const { SlashCommandBuilder } = require('discord.js');
const http = require('http2');
const url = "http://192.168.10.104:8000";
const axios = require('axios');


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
							{ name: 'Chlamydia', value: 'Chlamydia' },
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
						.setRequired(true))),

	async execute(interaction) {
		if(interaction.options.getSubCommand() === "add") {
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
			await interaction.reply(`This server is ${interaction.guild.name} and has ${interaction.guild.memberCount} members.`);
		}
		await interaction.reply("Il faut choisir une option. (add)")
	},
};