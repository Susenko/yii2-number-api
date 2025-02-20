#!/bin/bash

check_command() {
    if ! command -v $1 &> /dev/null; then
        echo "❌ $1 не встановлений. Будь ласка, встановіть його."
        exit 1
    fi
}

check_command git
check_command docker
check_command docker-compose

echo "✅ Всі необхідні інструменти встановлені."
