<h1>💰 PesoExchanger</h1>

<p><strong>Real-time Web Dashboard</strong> for a Bill-to-Coin Peso Exchanger Machine in the Philippines.</p>
<p>Built with <strong>Laravel</strong>, <strong>Firebase Realtime Database</strong>, and <strong>Blade UI</strong>. Developed by <strong>QPPD</strong>.</p>

<hr>

<h2>🔧 Tech Stack</h2>
<ul>
  <li><strong>Laravel</strong> – PHP backend framework</li>
  <li><strong>Firebase Realtime Database</strong> – Live data sync</li>
  <li><strong>Blade</strong> – Laravel templating engine</li>
  <li><strong>kreait/laravel-firebase</strong> – Firebase SDK for Laravel</li>
</ul>

<h2>📌 Key Features</h2>
<ul>
  <li>🟢 Real-time tracking of bill-to-coin transactions</li>
  <li>📊 Earnings summary and daily logs</li>
  <li>🗃 Historical data with exportable reports (CSV)</li>
  <li>🔐 Secure operator login system</li>
  <li>🇵🇭 Built specifically for Philippine-based machines</li>
</ul>

<h2>🎯 Use Case</h2>
<p>This app is deployed with an actual Peso Exchanger Machine. Each transaction syncs to Firebase instantly, enabling:</p>
<ul>
  <li>Remote monitoring of earnings and coin exchanges</li>
  <li>Audit-ready logs and performance summaries</li>
  <li>Data-driven decisions for maintenance and operations</li>
</ul>

<h2>📂 Installation</h2>

<pre><code>git clone https://github.com/qppd/PesoExchanger.git
cd PesoExchanger
composer install
cp .env.example .env
php artisan key:generate
php artisan serve
</code></pre>

<p>Set your Firebase credentials in the <code>.env</code> file:</p>

<pre><code>FIREBASE_DATABASE_URL=https://your-database.firebaseio.com/
FIREBASE_CREDENTIALS=/absolute/path/to/firebase-service-account.json
</code></pre>

<h2>⚙️ Firebase Setup</h2>
<ol>
  <li>Create a Firebase project</li>
  <li>Enable Realtime Database</li>
  <li>Download the service account JSON</li>
  <li>Add path to the credentials in your Laravel <code>.env</code></li>
</ol>

<h2>🙌 Made By</h2>
<p><strong>QPPD</strong> — Building connected solutions with IoT, AI, web, mobile, and hardware.</p>
<p>🔗 <a href="https://github.com/qppd">github.com/qppd</a></p>

<hr>
<p align="center"><em>For machine monitoring solutions, automation tools, and real-time dashboards — QPPD has you covered.</em></p>
