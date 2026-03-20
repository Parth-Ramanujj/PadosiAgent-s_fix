<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Speed Test - {{ config('app.name') }}</title>
    <style>
        :root {
            --good: #28a745;
            --medium: #ffc107;
            --slow: #dc3545;
        }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            padding: 30px; 
            max-width: 1000px; 
            margin: 0 auto;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        h1 { 
            color: #2c3e50; 
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .subtitle {
            color: #7f8c8d;
            margin-bottom: 30px;
        }
        .input-group {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        input {
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            flex: 1;
            min-width: 200px;
        }
        input:focus {
            border-color: #667eea;
            outline: none;
        }
        button {
            padding: 12px 25px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
        }
        .primary-btn {
            background: #667eea;
            color: white;
        }
        .primary-btn:hover {
            background: #5a67d8;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .secondary-btn {
            background: #f8f9fa;
            color: #495057;
            border: 2px solid #dee2e6;
        }
        .secondary-btn:hover {
            background: #e9ecef;
            transform: translateY(-2px);
        }
        #result {
            margin-top: 30px;
            padding: 25px;
            border-radius: 10px;
            border-left: 5px solid;
            animation: fadeIn 0.5s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .good { border-color: var(--good); background: #f0fff4; }
        .medium { border-color: var(--medium); background: #fffcf0; }
        .slow { border-color: var(--slow); background: #fff5f5; }
        .sample {
            background: white;
            padding: 15px;
            border-radius: 6px;
            margin-top: 15px;
            font-family: 'Monaco', 'Courier New', monospace;
            font-size: 13px;
            overflow: auto;
            max-height: 250px;
            border: 1px solid #e9ecef;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 25px;
        }
        .stat-box {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }
        .stat-value {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
        }
        .stat-label {
            font-size: 12px;
            color: #7f8c8d;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e9ecef;
        }
        th {
            background: #f8f9fa;
            font-weight: 600;
            color: #495057;
        }
        tr:hover {
            background: #f8f9fa;
        }
        .loader {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
            </svg>
            Laravel API Performance Test
        </h1>
        <p class="subtitle">Testing: <code>GET /api/test/{pincode}</code> endpoint</p>
        
        <div class="input-group">
            <input type="text" id="pincode" value="382424" placeholder="Enter 6-digit pincode">
            <button class="primary-btn" onclick="testSpeed()">
                <span id="btnText">Test Speed</span>
                <span id="btnLoader" style="display:none;" class="loader"></span>
            </button>
            <button class="secondary-btn" onclick="testMultiple()">Run 5 Tests</button>
            <button class="secondary-btn" onclick="clearHistory()">Clear History</button>
        </div>
        
        <div id="result"></div>
        
        <div class="stats" id="stats"></div>
        
        <div id="historySection" style="margin-top: 40px;">
            <h3>📊 Test History</h3>
            <div id="history"></div>
        </div>
    </div>
    
    <script>
    let testHistory = JSON.parse(localStorage.getItem('apiTestHistory') || '[]');
    
    function updateHistoryDisplay() {
        const historyDiv = document.getElementById('history');
        if (testHistory.length === 0) {
            historyDiv.innerHTML = '<p style="color:#7f8c8d; text-align:center;">No tests yet. Click "Test Speed" above.</p>';
            return;
        }
        
        const recent = [...testHistory].reverse().slice(0, 10);
        
        historyDiv.innerHTML = `
            <table>
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Pincode</th>
                        <th>Duration</th>
                        <th>Results</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    ${recent.map(test => `
                        <tr>
                            <td>${test.timestamp}</td>
                            <td><code>${test.pincode}</code></td>
                            <td style="font-weight:bold; color:${getTimeColor(test.time)}">
                                ${test.time.toFixed(0)}ms
                            </td>
                            <td>${test.results} pincodes</td>
                            <td>
                                <span style="display:inline-block; width:12px; height:12px; border-radius:50%; background:${getTimeColor(test.time)}"></span>
                                ${getPerformanceText(test.time)}
                            </td>
                        </tr>
                    `).join('')}
                </tbody>
            </table>
        `;
    }
    
    function getTimeColor(time) {
        if (time < 100) return '#28a745';
        if (time < 200) return '#ffc107';
        return '#dc3545';
    }
    
    function getPerformanceText(time) {
        if (time < 100) return 'Excellent';
        if (time < 200) return 'Good';
        if (time < 500) return 'Acceptable';
        return 'Slow';
    }
    
    function updateStats() {
        if (testHistory.length === 0) {
            document.getElementById('stats').innerHTML = '';
            return;
        }
        
        const times = testHistory.map(t => t.time);
        const avg = times.reduce((a, b) => a + b) / times.length;
        const min = Math.min(...times);
        const max = Math.max(...times);
        const last5 = testHistory.slice(-5).map(t => t.time);
        const avgLast5 = last5.reduce((a, b) => a + b) / last5.length;
        
        document.getElementById('stats').innerHTML = `
            <div class="stat-box">
                <div class="stat-value">${avg.toFixed(0)}ms</div>
                <div class="stat-label">Average Time</div>
            </div>
            <div class="stat-box">
                <div class="stat-value">${min.toFixed(0)}ms</div>
                <div class="stat-label">Best Time</div>
            </div>
            <div class="stat-box">
                <div class="stat-value">${max.toFixed(0)}ms</div>
                <div class="stat-label">Worst Time</div>
            </div>
            <div class="stat-box">
                <div class="stat-value">${avgLast5.toFixed(0)}ms</div>
                <div class="stat-label">Last 5 Avg</div>
            </div>
        `;
    }
    
    function clearHistory() {
        if (confirm('Clear all test history?')) {
            testHistory = [];
            localStorage.removeItem('apiTestHistory');
            updateHistoryDisplay();
            updateStats();
        }
    }
    
    async function testSpeed() {
        const pincode = document.getElementById('pincode').value.trim();
        if (!/^\d{6}$/.test(pincode)) {
            alert('Please enter a valid 6-digit pincode');
            return;
        }
        
        const url = `/api/test/${pincode}`;
        const resultDiv = document.getElementById('result');
        const btnText = document.getElementById('btnText');
        const btnLoader = document.getElementById('btnLoader');
        
        // Show loading state
        btnText.style.display = 'none';
        btnLoader.style.display = 'inline-block';
        resultDiv.innerHTML = '<p style="text-align:center; color:#667eea;">⏳ Testing API response...</p>';
        
        const start = performance.now();
        
        try {
            const response = await fetch(url);
            
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }
            
            const data = await response.json();
            const end = performance.now();
            const time = end - start;
            
            // Add to history
            const testResult = {
                pincode,
                time,
                timestamp: new Date().toLocaleTimeString(),
                results: data.nearby_100km?.length || 0,
                location: data.pincode_details?.office_name || 'Unknown'
            };
            
            testHistory.push(testResult);
            localStorage.setItem('apiTestHistory', JSON.stringify(testHistory));
            
            // Update displays
            updateDisplay(time, data, pincode);
            updateHistoryDisplay();
            updateStats();
            
        } catch (error) {
            resultDiv.innerHTML = `
                <div class="slow">
                    <h3>❌ API Error</h3>
                    <p><strong>${error.message}</strong></p>
                    <p>Possible issues:</p>
                    <ul>
                        <li>Check if Laravel server is running</li>
                        <li>Verify the route exists in routes/api.php</li>
                        <li>Check PincodeController@testPincode method</li>
                        <li>Ensure CORS is configured if testing from different port</li>
                    </ul>
                </div>
            `;
        } finally {
            // Restore button
            btnText.style.display = 'inline';
            btnLoader.style.display = 'none';
        }
    }
    
    function updateDisplay(time, data, pincode) {
        const resultDiv = document.getElementById('result');
        const speedClass = time < 100 ? 'good' : time < 200 ? 'medium' : 'slow';
        const rating = getPerformanceText(time);
        const emoji = time < 100 ? '⚡' : time < 200 ? '✅' : time < 500 ? '⚠️' : '🐌';
        
        resultDiv.innerHTML = `
            <div class="${speedClass}">
                <h2>${emoji} ${rating} - ${time.toFixed(0)}ms</h2>
                <p><strong>API Endpoint:</strong> <code>GET /api/test/${pincode}</code></p>
                <p><strong>Location:</strong> ${data.pincode_details?.office_name || 'Unknown'}</p>
                <p><strong>District:</strong> ${data.pincode_details?.district || 'Unknown'}</p>
                <p><strong>State:</strong> ${data.pincode_details?.state || 'Unknown'}</p>
                <p><strong>Nearby Pincodes Found:</strong> ${data.nearby_100km?.length || 0}</p>
                <hr style="margin:20px 0; border:none; border-top:1px solid #e9ecef;">
                <p><small><em>Direct URL in browser: ~3.45s | AJAX call: ${time.toFixed(0)}ms</em></small></p>
                
                ${data.nearby_100km?.length > 0 ? `
                <div class="sample">
                    <strong>Sample Results (first 5):</strong><br><br>
                    ${data.nearby_100km.slice(0, 5).map((item, i) => `
                        <div style="margin-bottom:8px; padding-bottom:8px; border-bottom:${i < 4 ? '1px solid #f0f0f0' : 'none'}">
                            <strong>${item.pincode}</strong> - ${item.office_name}<br>
                            <small>Distance: ${item.distance_km}km | District: ${item.district}</small>
                        </div>
                    `).join('')}
                </div>
                ` : ''}
            </div>
        `;
    }
    
    async function testMultiple() {
        const pincode = document.getElementById('pincode').value.trim();
        if (!/^\d{6}$/.test(pincode)) {
            alert('Please enter a valid 6-digit pincode');
            return;
        }
        
        const resultDiv = document.getElementById('result');
        resultDiv.innerHTML = '<p style="text-align:center;">Running 5 consecutive tests...</p>';
        
        const times = [];
        const errors = [];
        
        for (let i = 1; i <= 5; i++) {
            try {
                const start = performance.now();
                await fetch(`/api/test/${pincode}`);
                const time = performance.now() - start;
                times.push(time);
                
                // Update progress
                resultDiv.innerHTML = `<p style="text-align:center;">Test ${i}/5: ${time.toFixed(0)}ms</p>`;
                
                // Wait between tests
                if (i < 5) await new Promise(resolve => setTimeout(resolve, 300));
            } catch (error) {
                errors.push(`Test ${i}: ${error.message}`);
            }
        }
        
        if (errors.length > 0) {
            resultDiv.innerHTML = `
                <div class="slow">
                    <h3>❌ Multiple Test Errors</h3>
                    <p>${errors.join('<br>')}</p>
                </div>
            `;
            return;
        }
        
        const avg = times.reduce((a, b) => a + b) / times.length;
        const min = Math.min(...times);
        const max = Math.max(...times);
        const variance = max - min;
        
        resultDiv.innerHTML = `
            <div class="${avg < 100 ? 'good' : avg < 200 ? 'medium' : 'slow'}">
                <h2>📊 5-Test Analysis</h2>
                <p><strong>Average Response Time:</strong> ${avg.toFixed(0)}ms</p>
                <p><strong>Range:</strong> ${min.toFixed(0)}ms - ${max.toFixed(0)}ms</p>
                <p><strong>Variance:</strong> ${variance.toFixed(0)}ms</p>
                <p><strong>Individual Results:</strong> ${times.map(t => t.toFixed(0)).join(', ')}ms</p>
                <p><strong>Consistency:</strong> ${variance < 50 ? 'Excellent' : variance < 100 ? 'Good' : 'Variable'}</p>
            </div>
        `;
    }
    
    // Initialize
    updateHistoryDisplay();
    updateStats();
    </script>
</body>
</html>
