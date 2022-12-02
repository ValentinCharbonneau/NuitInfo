const { SlashCommandBuilder, EmbedBuilder } = require('discord.js');
const http = require('http2');
const url = "http://192.168.10.104:8000";
const axios = require('axios');
var treatment = "null";
var description = "null";
var symptom = "null";
var transmission = "null";
var embed = {};
module.exports = {
    data: new SlashCommandBuilder()
        .setName('mst')
        .setDescription('Provides information about the server.')
        .addSubcommand(add =>
            add.setName("info")
                .setDescription("Informations sur les mst")
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
                        ))),

    async execute(interaction) {

        let name = interaction.options.getString("mst");


        axios.get(`${url}/api/mst`).then(response => {
            console.log(response.data)


        })
        axios.get(encodeURI(`${url}/api/mst/${name}`)).then(response => {
            console.log(response.data)
            treatment = response.data.treatment
            transmission = response.data.transmission
            symptom = response.data.symptom
            description = response.data.description

        }).then(resp => {
            embed = new EmbedBuilder()
                .setAuthor({ name: `Informations sur ${name}`, iconURL: interaction.client.user.displayAvatarURL() })
                .setImage("https://i0.wp.com/www.coalitionplus.org/wp-content/uploads/2021/09/V2B-BANNIERE-FB-851X315-HD-scaled.jpg")
                .setThumbnail("https://pvsq.org/wp-content/uploads/2019/08/finalPlan-de-travail-4.png")
                .addFields({ name: "Description", value: description },
                    { name: "Type de transmission", value: transmission },
                    { name: "Symptôme", value: symptom },
                    { name: "Traitement", value: treatment })
            interaction.reply({ embeds: [embed] })

        })
            .catch(error => {
                console.log(error);
            });

    },
};