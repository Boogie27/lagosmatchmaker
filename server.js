const express = require('express')

const app = express()

const server = require('http').createServer(app)

const io = require('socket.io')(server, {
    cors: { origin: '*'}
})




io.on('connection', (socket) => {
    console.log('Connected...')

    socket.on('sendChat', (message) => {
        console.log(message)
    })

    socket.on('disconnect', (socket) => {
        console.log('Disconnected...')
    })
})



server.listen(3000, () => {
    console.log('Server is running...');
  });

