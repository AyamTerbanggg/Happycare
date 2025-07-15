document.addEventListener('DOMContentLoaded', () => {
    const chatbotToggleButton = document.getElementById('chatbot-toggle-button');
    const chatbotCloseButton = document.getElementById('chatbot-close-button');
    const chatbotWindow = document.getElementById('chatbot-window');
    const chatbotMessages = document.getElementById('chatbot-messages');
    const chatbotInput = document.getElementById('chatbot-input');
    const chatbotSendButton = document.getElementById('chatbot-send-button');
    const chatbotClearHistoryButton = document.getElementById('chatbot-clear-history-button');

    let currentTopic = null; // New variable to store the current topic
    const CHAT_HISTORY_KEY = 'chatbot_history'; // Key for localStorage

    // Function to load chat history from localStorage
    function loadChatHistory() {
        const history = JSON.parse(localStorage.getItem(CHAT_HISTORY_KEY)) || [];
        if (chatbotMessages) {
            chatbotMessages.innerHTML = ''; // Clear existing messages
            if (history.length === 0) {
                // Add initial bot message if no history
                addMessage('Halo! Ada yang bisa saya bantu terkait HappyCare?', 'bot');
            } else {
                history.forEach(item => {
                    addMessage(item.message, item.type, item.isHtml, item.timestamp);
                });
            }
            chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
        }
    }

    // Function to save message to localStorage
    function saveMessageToHistory(message, type, isHtml, timestamp) {
        const history = JSON.parse(localStorage.getItem(CHAT_HISTORY_KEY)) || [];
        history.push({ message, type, isHtml, timestamp });
        localStorage.setItem(CHAT_HISTORY_KEY, JSON.stringify(history));
    }

    // Function to load Tawk.to script dynamically
    function loadTawkToScript() {
        if (!window.Tawk_API) { // Check if Tawk.to is not already loaded
            var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
            (function() {
                var s1 = document.createElement("script"),
                    s0 = document.getElementsByTagName("script")[0];
                s1.async = true;
                s1.src = 'https://embed.tawk.to/681f2c82fe55ac190d564d5c/1iqssbno7';
                s1.charset = 'UTF-8';
                s1.setAttribute('crossorigin', '*');
                s0.parentNode.insertBefore(s1, s0);
            })();
            
            // Optional: You can add an event listener for when Tawk.to is loaded
            // Tawk_API.onLoad = function() {
            //     console.log('Tawk.to chat loaded!');
            // };
            addMessage('Mohon tunggu sebentar, Anda akan diarahkan ke obrolan langsung dengan agen kami.', 'bot');
            setTimeout(() => {
                // Open Tawk.to widget if it's minimized or not visible
                if (window.Tawk_API) {
                    window.Tawk_API.maximize();
                }
            }, 1000); // Give a small delay for Tawk.to to initialize
        }
    }

    // Sembunyikan tombol chatbot custom saat Tawk.to terbuka
    function hideChatbotButton() {
        const btn = document.getElementById('chatbot-toggle-button');
        if (btn) btn.style.display = 'none';
    }
    function showChatbotButton() {
        const btn = document.getElementById('chatbot-toggle-button');
        if (btn) btn.style.display = '';
    }
    // Integrasi dengan Tawk.to events
    window.Tawk_API = window.Tawk_API || {};
    window.Tawk_API.onChatMaximized = function(){ hideChatbotButton(); };
    window.Tawk_API.onChatMinimized = function(){ showChatbotButton(); };
    window.Tawk_API.onChatHidden = function(){ showChatbotButton(); };

    // Initial load of chat history
    if (chatbotMessages) {
        loadChatHistory();
    }

    // --- Tambahan: Modal Pilihan Chat ---
    const chatChoiceModal = document.getElementById('chat-choice-modal');
    const chooseChatbotBtn = document.getElementById('choose-chatbot');
    const chooseLivechatBtn = document.getElementById('choose-livechat');
    const closeChatChoiceBtn = document.getElementById('close-chat-choice');

    // Ubah event tombol utama chatbot menjadi buka modal pilihan
    if (chatbotToggleButton && chatChoiceModal) {
        chatbotToggleButton.addEventListener('click', () => {
            chatChoiceModal.style.display = 'flex';
        });
    }
    // Pilih Chatbot
    if (chooseChatbotBtn && chatbotWindow && chatChoiceModal) {
        chooseChatbotBtn.addEventListener('click', () => {
            chatChoiceModal.style.display = 'none';
            chatbotWindow.classList.add('active');
            if (chatbotMessages) chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
            if (chatbotInput) chatbotInput.focus();
        });
    }
    // Pilih Live Chat (Tawk.to)
    if (chooseLivechatBtn && chatChoiceModal) {
        chooseLivechatBtn.addEventListener('click', () => {
            chatChoiceModal.style.display = 'none';
            loadTawkToScript();
        });
    }
    // Tutup modal
    if (closeChatChoiceBtn && chatChoiceModal) {
        closeChatChoiceBtn.addEventListener('click', () => {
            chatChoiceModal.style.display = 'none';
        });
    }

    // Toggle chatbot window
    if (chatbotToggleButton && chatbotWindow && chatbotMessages && chatbotInput) {
        chatbotToggleButton.addEventListener('click', () => {
            chatbotWindow.classList.toggle('active');
            if (chatbotWindow.classList.contains('active')) {
                chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
                chatbotInput.focus();
            }
        });
    }

    // Clear history button event listener
    if (chatbotClearHistoryButton) {
        chatbotClearHistoryButton.addEventListener('click', () => {
            localStorage.removeItem(CHAT_HISTORY_KEY);
            currentTopic = null; // Reset topic
            loadChatHistory(); // Reloads with initial message
        });
    }

    // Close chatbot window
    if (chatbotCloseButton && chatbotWindow) {
        chatbotCloseButton.addEventListener('click', () => {
            chatbotWindow.classList.remove('active');
        });
    }

    // Function to add message to chat window
    function addMessage(message, type, isHtml = false, timestamp = new Date().toLocaleString()) {
        if (!chatbotMessages) return;
        const messageDiv = document.createElement('div');
        messageDiv.classList.add('message', `${type}-message`);
        if (isHtml) {
            messageDiv.innerHTML = message;
        } else {
            messageDiv.textContent = message;
        }
        
        const timestampSpan = document.createElement('span');
        timestampSpan.classList.add('timestamp');
        timestampSpan.textContent = timestamp;
        timestampSpan.style.fontSize = '0.75em';
        timestampSpan.style.display = 'block';
        timestampSpan.style.marginTop = '5px';
        messageDiv.appendChild(timestampSpan);

        chatbotMessages.appendChild(messageDiv);
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
    }

    // Fungsi untuk menampilkan pilihan di dalam chat
    function showChatChoiceInChat() {
        if (!chatbotMessages) return;
        // Hapus pilihan jika sudah ada
        const existingChoice = document.getElementById('chat-choice-in-chat');
        if (existingChoice) existingChoice.remove();
        // Buat container
        const choiceDiv = document.createElement('div');
        choiceDiv.id = 'chat-choice-in-chat';
        choiceDiv.style.display = 'flex';
        choiceDiv.style.flexDirection = 'column';
        choiceDiv.style.alignItems = 'center';
        choiceDiv.style.margin = '18px 0 10px 0';
        // Tombol Chatbot
        const btnChatbot = document.createElement('button');
        btnChatbot.textContent = 'Lanjut ke Chatbot';
        btnChatbot.className = 'btn btn-primary mb-2';
        btnChatbot.style.width = '90%';
        btnChatbot.style.fontWeight = '600';
        // Tombol Live Chat
        const btnLiveChat = document.createElement('button');
        btnLiveChat.textContent = 'Live Chat (Tawk.to)';
        btnLiveChat.className = 'btn btn-success';
        btnLiveChat.style.width = '90%';
        btnLiveChat.style.fontWeight = '600';
        // Event
        btnChatbot.onclick = function() {
            choiceDiv.remove();
            chatbotInput.disabled = false;
            chatbotInput.focus();
        };
        btnLiveChat.onclick = function() {
            choiceDiv.remove();
            chatbotWindow.classList.remove('active');
            loadTawkToScript();
        };
        // Tambah ke container
        choiceDiv.appendChild(btnChatbot);
        choiceDiv.appendChild(btnLiveChat);
        chatbotMessages.appendChild(choiceDiv);
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
        // Disable input sampai pilih
        if (chatbotInput) chatbotInput.disabled = true;
    }

    // Tampilkan pilihan saat chatbot window dibuka pertama kali
    if (chatbotWindow) {
        const observer = new MutationObserver(() => {
            if (chatbotWindow.classList.contains('active')) {
                // Cek jika belum ada pilihan
                if (!document.getElementById('chat-choice-in-chat')) {
                    showChatChoiceInChat();
                }
            }
        });
        observer.observe(chatbotWindow, { attributes: true, attributeFilter: ['class'] });
    }

    // Handle user input and bot response
    function handleUserInput() {
        const userInput = chatbotInput.value.trim();
        if (userInput === '') return;

        // Add user message and save to history
        const userTimestamp = new Date().toLocaleString();
        addMessage(userInput, 'user', false, userTimestamp);
        saveMessageToHistory(userInput, 'user', false, userTimestamp);
        chatbotInput.value = '';

        // Define bot response here for non-API calls
        let botResponse = 'Maaf, saya tidak dapat memahami pertanyaan Anda saat ini. Saya akan menghubungkan Anda dengan agen langsung.';

        const lowerCaseInput = userInput.toLowerCase();

        // Helper function to fetch data and add message
        async function fetchDataAndRespond(endpoint, city) {
            try {
                const response = await fetch(`/api/chatbot/${endpoint}?city=${city}`);
                const result = await response.json();

                let messageContent = result.message;
                if (result.link) {
                    messageContent += `<br/><br/><a href="${result.link}" target="_blank" class="btn btn-sm btn-info mt-2">Lihat Selengkapnya</a>`;
                }
                const botTimestamp = new Date().toLocaleString();
                addMessage(messageContent, 'bot', true, botTimestamp);
                saveMessageToHistory(messageContent, 'bot', true, botTimestamp);

            } catch (error) {
                console.error('Error fetching data:', error);
                const errorMessage = 'Maaf, terjadi kesalahan saat mengambil data. Silakan coba lagi nanti.';
                const botTimestamp = new Date().toLocaleString();
                addMessage(errorMessage, 'bot', false, botTimestamp);
                saveMessageToHistory(errorMessage, 'bot', false, botTimestamp);
            }
        }

        // Prioritize specific queries first
        if (lowerCaseInput.includes('rumah sakit semarang')) {
            currentTopic = 'rumah_sakit'; // Set topic for continuity
            fetchDataAndRespond('hospitals', 'semarang');
        } else if (lowerCaseInput.includes('rumah sakit solo') || lowerCaseInput.includes('rumah sakit surakarta')) {
            currentTopic = 'rumah_sakit';
            fetchDataAndRespond('hospitals', 'solo');
        } else if (lowerCaseInput.includes('wisata semarang')) {
            currentTopic = 'wisata';
            fetchDataAndRespond('tourism', 'semarang');
        } else if (lowerCaseInput.includes('wisata solo') || lowerCaseInput.includes('wisata surakarta')) {
            currentTopic = 'wisata';
            fetchDataAndRespond('tourism', 'solo');
        } else if (lowerCaseInput.includes('rumah sakit bantul')) {
            currentTopic = 'rumah_sakit';
            fetchDataAndRespond('hospitals', 'bantul');
        } else if (lowerCaseInput.includes('wisata bantul')) {
            currentTopic = 'wisata';
            fetchDataAndRespond('tourism', 'bantul');
        } else if (lowerCaseInput.includes('rumah sakit banyumas')) {
            currentTopic = 'rumah_sakit';
            fetchDataAndRespond('hospitals', 'banyumas');
        } else if (lowerCaseInput.includes('wisata banyumas')) {
            currentTopic = 'wisata';
            fetchDataAndRespond('tourism', 'banyumas');
        } else if (lowerCaseInput.includes('rumah sakit jepara')) {
            currentTopic = 'rumah_sakit';
            fetchDataAndRespond('hospitals', 'jepara');
        } else if (lowerCaseInput.includes('wisata jepara')) {
            currentTopic = 'wisata';
            fetchDataAndRespond('tourism', 'jepara');
        } else if (lowerCaseInput.includes('rumah sakit kebumen')) {
            currentTopic = 'rumah_sakit';
            fetchDataAndRespond('hospitals', 'kebumen');
        } else if (lowerCaseInput.includes('wisata kebumen')) {
            currentTopic = 'wisata';
            fetchDataAndRespond('tourism', 'kebumen');
        } else if (lowerCaseInput.includes('rumah sakit klaten')) {
            currentTopic = 'rumah_sakit';
            fetchDataAndRespond('hospitals', 'klaten');
        } else if (lowerCaseInput.includes('wisata klaten')) {
            currentTopic = 'wisata';
            fetchDataAndRespond('tourism', 'klaten');
        } else if (lowerCaseInput.includes('rumah sakit wonosobo')) {
            currentTopic = 'rumah_sakit';
            fetchDataAndRespond('hospitals', 'wonosobo');
        } else if (lowerCaseInput.includes('wisata wonosobo')) {
            currentTopic = 'wisata';
            fetchDataAndRespond('tourism', 'wonosobo');
        }
        // Then handle general topic queries, setting currentTopic
        else if (lowerCaseInput.includes('rumah sakit')) {
            currentTopic = 'rumah_sakit';
            botResponse = 'HappyCare menyediakan informasi mengenai daftar rumah sakit di Jawa Tengah, termasuk lokasi dan layanan. Anda bisa melihatnya di halaman Rumah Sakit. Bisakah Anda sebutkan kota yang ingin Anda cari? (Contoh: Semarang, Solo, Yogyakarta)';
            setTimeout(() => {
                addMessage(botResponse, 'bot');
                saveMessageToHistory(botResponse, 'bot', false, new Date().toLocaleString());
            }, 500);
        } else if (lowerCaseInput.includes('wisata')) {
            currentTopic = 'wisata';
            botResponse = 'HappyCare juga memberikan informasi tentang destinasi wisata di Jawa Tengah. Jelajahi tempat-tempat menarik di halaman Wisata. Kota mana yang ingin Anda jelajahi? (Contoh: Semarang, Solo, Yogyakarta)';
            setTimeout(() => {
                addMessage(botResponse, 'bot');
                saveMessageToHistory(botResponse, 'bot', false, new Date().toLocaleString());
            }, 500);
        }
        // Handle just city names, using currentTopic for context
        else if (lowerCaseInput.includes('semarang')) {
            if (currentTopic === 'rumah_sakit') {
                fetchDataAndRespond('hospitals', 'semarang');
            } else if (currentTopic === 'wisata') {
                fetchDataAndRespond('tourism', 'semarang');
            } else {
                botResponse = 'Anda mencari informasi rumah sakit atau tempat wisata di Semarang?';
                setTimeout(() => {
                    addMessage(botResponse, 'bot');
                    saveMessageToHistory(botResponse, 'bot', false, new Date().toLocaleString());
                }, 500);
            }
        } else if (lowerCaseInput.includes('solo') || lowerCaseInput.includes('surakarta')) {
            if (currentTopic === 'rumah_sakit') {
                fetchDataAndRespond('hospitals', 'solo');
            } else if (currentTopic === 'wisata') {
                fetchDataAndRespond('tourism', 'solo');
            } else {
                botResponse = 'Apakah Anda mencari informasi rumah sakit atau tempat wisata di Solo/Surakarta?';
                setTimeout(() => {
                    addMessage(botResponse, 'bot');
                    saveMessageToHistory(botResponse, 'bot', false, new Date().toLocaleString());
                }, 500);
            }
        } else if (lowerCaseInput.includes('yogyakarta') || lowerCaseInput.includes('jogja')) {
            if (currentTopic === 'rumah_sakit') {
                fetchDataAndRespond('hospitals', 'yogyakarta');
            } else if (currentTopic === 'wisata') {
                fetchDataAndRespond('tourism', 'yogyakarta');
            } else {
                botResponse = 'Anda mencari informasi rumah sakit atau tempat wisata di Yogyakarta?';
                setTimeout(() => {
                    addMessage(botResponse, 'bot');
                    saveMessageToHistory(botResponse, 'bot', false, new Date().toLocaleString());
                }, 500);
            }
        } else if (lowerCaseInput.includes('magelang')) {
            if (currentTopic === 'rumah_sakit') {
                fetchDataAndRespond('hospitals', 'magelang');
            } else if (currentTopic === 'wisata') {
                fetchDataAndRespond('tourism', 'magelang');
            } else {
                botResponse = 'Anda mencari informasi rumah sakit atau tempat wisata di Magelang?';
                setTimeout(() => {
                    addMessage(botResponse, 'bot');
                    saveMessageToHistory(botResponse, 'bot', false, new Date().toLocaleString());
                }, 500);
            }
        } else if (lowerCaseInput.includes('bantul')) {
            if (currentTopic === 'rumah_sakit') {
                fetchDataAndRespond('hospitals', 'bantul');
            } else if (currentTopic === 'wisata') {
                fetchDataAndRespond('tourism', 'bantul');
            } else {
                botResponse = 'Anda mencari informasi rumah sakit atau tempat wisata di Bantul?';
                setTimeout(() => {
                    addMessage(botResponse, 'bot');
                    saveMessageToHistory(botResponse, 'bot', false, new Date().toLocaleString());
                }, 500);
            }
        } else if (lowerCaseInput.includes('banyumas')) {
            if (currentTopic === 'rumah_sakit') {
                fetchDataAndRespond('hospitals', 'banyumas');
            } else if (currentTopic === 'wisata') {
                fetchDataAndRespond('tourism', 'banyumas');
            } else {
                botResponse = 'Anda mencari informasi rumah sakit atau tempat wisata di Banyumas?';
                setTimeout(() => {
                    addMessage(botResponse, 'bot');
                    saveMessageToHistory(botResponse, 'bot', false, new Date().toLocaleString());
                }, 500);
            }
        } else if (lowerCaseInput.includes('jepara')) {
            if (currentTopic === 'rumah_sakit') {
                fetchDataAndRespond('hospitals', 'jepara');
            } else if (currentTopic === 'wisata') {
                fetchDataAndRespond('tourism', 'jepara');
            } else {
                botResponse = 'Anda mencari informasi rumah sakit atau tempat wisata di Jepara?';
                setTimeout(() => {
                    addMessage(botResponse, 'bot');
                    saveMessageToHistory(botResponse, 'bot', false, new Date().toLocaleString());
                }, 500);
            }
        } else if (lowerCaseInput.includes('kebumen')) {
            if (currentTopic === 'rumah_sakit') {
                fetchDataAndRespond('hospitals', 'kebumen');
            } else if (currentTopic === 'wisata') {
                fetchDataAndRespond('tourism', 'kebumen');
            } else {
                botResponse = 'Anda mencari informasi rumah sakit atau tempat wisata di Kebumen?';
                setTimeout(() => {
                    addMessage(botResponse, 'bot');
                    saveMessageToHistory(botResponse, 'bot', false, new Date().toLocaleString());
                }, 500);
            }
        } else if (lowerCaseInput.includes('klaten')) {
            if (currentTopic === 'rumah_sakit') {
                fetchDataAndRespond('hospitals', 'klaten');
            } else if (currentTopic === 'wisata') {
                fetchDataAndRespond('tourism', 'klaten');
            } else {
                botResponse = 'Anda mencari informasi rumah sakit atau tempat wisata di Klaten?';
                setTimeout(() => {
                    addMessage(botResponse, 'bot');
                    saveMessageToHistory(botResponse, 'bot', false, new Date().toLocaleString());
                }, 500);
            }
        } else if (lowerCaseInput.includes('wonosobo')) {
            if (currentTopic === 'rumah_sakit') {
                fetchDataAndRespond('hospitals', 'wonosobo');
            } else if (currentTopic === 'wisata') {
                fetchDataAndRespond('tourism', 'wonosobo');
            } else {
                botResponse = 'Anda mencari informasi rumah sakit atau tempat wisata di Wonosobo?';
                setTimeout(() => {
                    addMessage(botResponse, 'bot');
                    saveMessageToHistory(botResponse, 'bot', false, new Date().toLocaleString());
                }, 500);
            }
        } 
        // General greetings and questions, reset topic
        else if (lowerCaseInput.includes('kontak')) {
            currentTopic = null; 
            botResponse = 'Untuk pertanyaan lebih lanjut atau bantuan, Anda bisa menghubungi kami melalui halaman Kontak atau email info@happycare.com.';
            setTimeout(() => {
                addMessage(botResponse, 'bot');
                saveMessageToHistory(botResponse, 'bot', false, new Date().toLocaleString());
            }, 500);
        } else if (lowerCaseInput.includes('halo') || lowerCaseInput.includes('hai') || lowerCaseInput.includes('hi')) {
            currentTopic = null;
            botResponse = 'Halo! Ada yang bisa saya bantu terkait HappyCare?';
            setTimeout(() => {
                addMessage(botResponse, 'bot');
                saveMessageToHistory(botResponse, 'bot', false, new Date().toLocaleString());
            }, 500);
        } else if (lowerCaseInput.includes('terima kasih') || lowerCaseInput.includes('makasih')) {
            currentTopic = null;
            botResponse = 'Sama-sama! Senang bisa membantu.';
            setTimeout(() => {
                addMessage(botResponse, 'bot');
                saveMessageToHistory(botResponse, 'bot', false, new Date().toLocaleString());
            }, 500);
        } else if (lowerCaseInput.includes('tentang happycare')) {
            currentTopic = null;
            botResponse = 'HappyCare adalah platform yang menyediakan informasi kesehatan dan wisata di Jawa Tengah.';
            setTimeout(() => {
                addMessage(botResponse, 'bot');
                saveMessageToHistory(botResponse, 'bot', false, new Date().toLocaleString());
            }, 500);
        } else if (lowerCaseInput.includes('layanan')) {
            currentTopic = null;
            botResponse = 'Kami menyediakan informasi tentang rumah sakit, destinasi wisata, dan kontak untuk bantuan lebih lanjut.';
            setTimeout(() => {
                addMessage(botResponse, 'bot');
                saveMessageToHistory(botResponse, 'bot', false, new Date().toLocaleString());
            }, 500);
        } else if (lowerCaseInput.includes('lokasi')) {
            currentTopic = null;
            botResponse = 'HappyCare berfokus pada informasi di wilayah Jawa Tengah.';
            setTimeout(() => {
                addMessage(botResponse, 'bot');
                saveMessageToHistory(botResponse, 'bot', false, new Date().toLocaleString());
            }, 500);
        } else { // Fallback for unrecognized input
            setTimeout(() => {
                addMessage(botResponse, 'bot');
                saveMessageToHistory(botResponse, 'bot', false, new Date().toLocaleString());
            }, 500);
        }

        if (botResponse === 'Maaf, saya tidak dapat memahami pertanyaan Anda saat ini. Saya akan menghubungkan Anda dengan agen langsung.') {
            loadTawkToScript();
        }
    }

    // Event listeners for sending message
    if (chatbotSendButton && chatbotInput) {
        chatbotSendButton.addEventListener('click', handleUserInput);
        chatbotInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                handleUserInput();
            }
        });
    }
}); 