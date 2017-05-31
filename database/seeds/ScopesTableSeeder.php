<?php

use Illuminate\Database\Seeder;
use App\Models\Scope;

class ScopesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $scopes = [
            [
                'id' => 1, 'name' => 'Hardware', 'children' =>
                [
                    ['id' => 2, 'name' => 'Printed circuit boards'],
                    ['id' => 3, 'name' => 'Communication hardware, interfaces and storage'],
                    ['id' => 4, 'name' => 'Integrated circuits'],
                    ['id' => 5, 'name' => 'Very large scale integration design'],
                    ['id' => 6, 'name' => 'Power and energy'],
                    ['id' => 7, 'name' => 'Electronic design automation'],
                    ['id' => 8, 'name' => 'Hardware validation'],
                    ['id' => 9, 'name' => 'Hardware test'],
                    ['id' => 10, 'name' => 'Robustness'],
                    ['id' => 11, 'name' => 'Emerging technologies'],
                ]
            ],
            [
                'id' => 12, 'name' => 'Computer systems organization', 'children' =>
                [
                    ['id' => 13, 'name' => 'Architectures'],
                    ['id' => 14, 'name' => 'Embedded and cyber-physical systems'],
                    ['id' => 15, 'name' => 'Real-time systems'],
                    ['id' => 16, 'name' => 'Dependable and fault-tolerant systems and networks'],
                ]
            ],
            [
                'id' => 17, 'name' => 'Networks', 'children' =>
                [
                    ['id' => 18, 'name' => 'Network architectures'],
                    ['id' => 19, 'name' => 'Network protocols'],
                    ['id' => 20, 'name' => 'Network components'],
                    ['id' => 21, 'name' => 'Network algorithms'],
                    ['id' => 22, 'name' => 'Network performance evaluation'],
                    ['id' => 23, 'name' => 'Network properties'],
                    ['id' => 24, 'name' => 'Network services'],
                    ['id' => 25, 'name' => 'Network types'],
                ]
            ],
            [
                'id' => 26, 'name' => 'Software and its engineering', 'children' =>
                [
                    ['id' => 27, 'name' => ' Software organization and properties'],
                    ['id' => 28, 'name' => 'Software notations and tools'],
                    ['id' => 29, 'name' => 'Software creation and management'],
                ]
            ],
            [
                'id' => 30, 'name' => 'Theory of computation', 'children' =>
                [
                    ['id' => 31, 'name' => 'Models of computation'],
                    ['id' => 32, 'name' => 'Formal languages and automata theory'],
                    ['id' => 33, 'name' => 'Computational complexity and cryptography'],
                    ['id' => 34, 'name' => 'Logic'],
                    ['id' => 35, 'name' => 'Design and analysis of algorithms'],
                    ['id' => 36, 'name' => 'Randomness, geometry and discrete structures'],
                    ['id' => 37, 'name' => 'Theory and algorithms for application domains'],
                    ['id' => 38, 'name' => 'Semantics and reasoning'],
                ]
            ],
            [
                'id' => 39, 'name' => 'Mathematics of computing', 'children' =>
                [
                    ['id' => 40, 'name' => 'Discrete mathematics'],
                    ['id' => 41, 'name' => 'Probability and statistics'],
                    ['id' => 42, 'name' => 'Mathematical software'],
                    ['id' => 43, 'name' => 'Information theory'],
                    ['id' => 44, 'name' => 'Mathematical analysis'],
                    ['id' => 45, 'name' => 'Continuous mathematics'],
                ]
            ],
            [
                'id' => 46, 'name' => 'Information systems', 'children' =>
                [
                    ['id' => 47, 'name' => 'Data management systems'],
                    ['id' => 48, 'name' => 'Information storage systems'],
                    ['id' => 49, 'name' => 'Information systems applications'],
                    ['id' => 50, 'name' => 'World Wide Web'],
                    ['id' => 51, 'name' => 'Information retrieval'],
                ]
            ],
            [
                'id' => 52, 'name' => 'Security and privacy', 'children' =>
                [
                    ['id' => 53, 'name' => 'Cryptography'],
                    ['id' => 54, 'name' => 'Formal methods and theory of security'],
                    ['id' => 55, 'name' => 'Security services'],
                    ['id' => 56, 'name' => 'Intrusion/anomaly detection and malware mitigation'],
                    ['id' => 57, 'name' => 'Security in hardware'],
                    ['id' => 58, 'name' => 'Systems security'],
                    ['id' => 59, 'name' => 'Network security'],
                    ['id' => 60, 'name' => 'Database and storage security'],
                    ['id' => 61, 'name' => 'Software and application security'],
                    ['id' => 62, 'name' => 'Human and societal aspects of security and privacy'],
                ]
            ],
            [
                'id' => 63, 'name' => 'Human-centered computing', 'children' =>
                [
                    ['id' => 64, 'name' => 'Human–computer interaction'],
                    ['id' => 65, 'name' => 'Interaction design'],
                    ['id' => 66, 'name' => 'Collaborative and social computing'],
                    ['id' => 67, 'name' => 'Ubiquitous and mobile computing'],
                    ['id' => 68, 'name' => 'Visualization'],
                    ['id' => 69, 'name' => 'Accessibility'],
                ]
            ],
            [
                'id' => 70, 'name' => 'Computing methodologies', 'children' =>
                [
                    ['id' => 71, 'name' => 'Symbolic and algebraic manipulation'],
                    ['id' => 72, 'name' => 'Parallel computing methodologies'],
                    ['id' => 73, 'name' => 'Artificial intelligence'],
                    ['id' => 74, 'name' => 'Machine learning'],
                    ['id' => 75, 'name' => 'Modeling and simulation'],
                    ['id' => 76, 'name' => 'Computer graphics'],
                    ['id' => 77, 'name' => 'Distributed computing methodologies'],
                    ['id' => 78, 'name' => 'Concurrent computing methodologies'],
                ]
            ],
            [
                'id' => 79, 'name' => 'Applied computing', 'children' =>
                [
                    ['id' => 80, 'name' => 'Electronic commerce'],
                    ['id' => 81, 'name' => 'Enterprise computing'],
                    ['id' => 82, 'name' => 'Physical sciences and engineering'],
                    ['id' => 83, 'name' => 'Life and medical sciences'],
                    ['id' => 84, 'name' => 'Law, social and behavioral sciences'],
                    ['id' => 85, 'name' => 'Computer forensics'],
                    ['id' => 86, 'name' => 'Arts and humanities'],
                    ['id' => 87, 'name' => 'Computers in other domains'],
                    ['id' => 88, 'name' => 'Operations research'],
                    ['id' => 89, 'name' => 'Education'],
                    ['id' => 90, 'name' => 'Document management and text processing'],
                ]
            ],
        ];

        Scope::buildTree($scopes);
    }
}
