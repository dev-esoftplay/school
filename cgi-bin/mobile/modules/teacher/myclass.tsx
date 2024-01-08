// withHooks

import { MaterialIcons } from '@expo/vector-icons';
import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibStyle } from 'esoftplay/cache/lib/style/import';
import React, { useState } from 'react';
import { memo } from 'react';
import { View, Platform, Text, FlatList, ScrollView, Pressable } from 'react-native';
import { TouchableOpacity } from 'react-native-gesture-handler';


export interface TeacherMyClassArgs {

}
export interface TeacherMyClassProps {

}
function m(props: TeacherMyClassProps): any {

    function shadowS(value: any) {
        if (Platform.OS === "ios") {
            if (value === 0) return {};
            return { shadowColor: '#000000', shadowOffset: { width: 0, height: value / 2 }, shadowRadius: value, shadowOpacity: 0.24 }
        }
        return { elevation: value };
    }
    const allTabs = ['Jadwal Kelas', 'Daftar Siswa'];
    const [selectTab, setSelectTab] = React.useState(allTabs[0])

    const Tabs = () => {
        if (selectTab == 'Jadwal Kelas') {
            const allDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
            const [selectedDay, setSelectedDay] = useState(allDays[0]);
            const scheduleData = [
                {
                    day: 'Monday',
                    events: [
                        { subject: 'Mathematics', jamke: 'jam ke 1 - jam ke 2', jam: '06:45 - 07:45', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Physics', jamke: 'jam ke 3 - jam ke 4', jam: '08:00 - 09:00', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Chemistry', jamke: 'jam ke 5 - jam ke 6', jam: '09:15 - 10:15', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Biology', jamke: 'jam ke 7 - jam ke 8', jam: '10:30 - 11:30', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'History', jamke: 'jam ke 9 - jam ke 10', jam: '13:00 - 14:00', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Literature', jamke: 'jam ke 11 - jam ke 12', jam: '14:15 - 15:15', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'English', jamke: 'jam ke 13 - jam ke 14', jam: '15:30 - 16:30', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Computer Science', jamke: 'jam ke 15 - jam ke 16', jam: '16:45 - 17:45', jumlahSiswa: '30/30', color: 'green' },
                    ]
                },
                {
                    day: 'Tuesday',
                    events: [
                        { subject: 'Mathematics', jamke: 'jam ke 1 - jam ke 2', jam: '06:45 - 07:45', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Physics', jamke: 'jam ke 3 - jam ke 4', jam: '08:00 - 09:00', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Chemistry', jamke: 'jam ke 5 - jam ke 6', jam: '09:15 - 10:15', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Biology', jamke: 'jam ke 7 - jam ke 8', jam: '10:30 - 11:30', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'History', jamke: 'jam ke 9 - jam ke 10', jam: '13:00 - 14:00', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Literature', jamke: 'jam ke 11 - jam ke 12', jam: '14:15 - 15:15', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'English', jamke: 'jam ke 13 - jam ke 14', jam: '15:30 - 16:30', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Computer Science', jamke: 'jam ke 15 - jam ke 16', jam: '16:45 - 17:45', jumlahSiswa: '30/30', color: 'green' },
                    ]
                },
                {
                    day: 'Wednesday',
                    events: [
                        { subject: 'Mathematics', jamke: 'jam ke 1 - jam ke 2', jam: '06:45 - 07:45', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Physics', jamke: 'jam ke 3 - jam ke 4', jam: '08:00 - 09:00', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Chemistry', jamke: 'jam ke 5 - jam ke 6', jam: '09:15 - 10:15', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Biology', jamke: 'jam ke 7 - jam ke 8', jam: '10:30 - 11:30', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'History', jamke: 'jam ke 9 - jam ke 10', jam: '13:00 - 14:00', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Literature', jamke: 'jam ke 11 - jam ke 12', jam: '14:15 - 15:15', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'English', jamke: 'jam ke 13 - jam ke 14', jam: '15:30 - 16:30', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Computer Science', jamke: 'jam ke 15 - jam ke 16', jam: '16:45 - 17:45', jumlahSiswa: '30/30', color: 'green' },
                    ]
                },
                {
                    day: 'Thursday',
                    events: [
                        { subject: 'Mathematics', jamke: 'jam ke 1 - jam ke 2', jam: '06:45 - 07:45', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Physics', jamke: 'jam ke 3 - jam ke 4', jam: '08:00 - 09:00', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Chemistry', jamke: 'jam ke 5 - jam ke 6', jam: '09:15 - 10:15', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Biology', jamke: 'jam ke 7 - jam ke 8', jam: '10:30 - 11:30', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'History', jamke: 'jam ke 9 - jam ke 10', jam: '13:00 - 14:00', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Literature', jamke: 'jam ke 11 - jam ke 12', jam: '14:15 - 15:15', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'English', jamke: 'jam ke 13 - jam ke 14', jam: '15:30 - 16:30', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Computer Science', jamke: 'jam ke 15 - jam ke 16', jam: '16:45 - 17:45', jumlahSiswa: '30/30', color: 'green' },
                    ]
                },
                {
                    day: 'Friday',
                    events: [
                        { subject: 'Mathematics', jamke: 'jam ke 1 - jam ke 2', jam: '06:45 - 07:45', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Physics', jamke: 'jam ke 3 - jam ke 4', jam: '08:00 - 09:00', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Chemistry', jamke: 'jam ke 5 - jam ke 6', jam: '09:15 - 10:15', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Biology', jamke: 'jam ke 7 - jam ke 8', jam: '10:30 - 11:30', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'History', jamke: 'jam ke 9 - jam ke 10', jam: '13:00 - 14:00', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Literature', jamke: 'jam ke 11 - jam ke 12', jam: '14:15 - 15:15', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'English', jamke: 'jam ke 13 - jam ke 14', jam: '15:30 - 16:30', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Computer Science', jamke: 'jam ke 15 - jam ke 16', jam: '16:45 - 17:45', jumlahSiswa: '30/30', color: 'green' },
                    ]
                },
                {
                    day: 'Saturday',
                    events: [
                        { subject: 'Mathematics', jamke: 'jam ke 1 - jam ke 2', jam: '06:45 - 07:45', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Physics', jamke: 'jam ke 3 - jam ke 4', jam: '08:00 - 09:00', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Chemistry', jamke: 'jam ke 5 - jam ke 6', jam: '09:15 - 10:15', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Biology', jamke: 'jam ke 7 - jam ke 8', jam: '10:30 - 11:30', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'History', jamke: 'jam ke 9 - jam ke 10', jam: '13:00 - 14:00', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Literature', jamke: 'jam ke 11 - jam ke 12', jam: '14:15 - 15:15', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'English', jamke: 'jam ke 13 - jam ke 14', jam: '15:30 - 16:30', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Computer Science', jamke: 'jam ke 15 - jam ke 16', jam: '16:45 - 17:45', jumlahSiswa: '30/30', color: 'green' },
                    ]
                },
                {
                    day: 'Sunday',
                    events: [
                        { subject: 'Mathematics', jamke: 'jam ke 1 - jam ke 2', jam: '06:45 - 07:45', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Physics', jamke: 'jam ke 3 - jam ke 4', jam: '08:00 - 09:00', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Chemistry', jamke: 'jam ke 5 - jam ke 6', jam: '09:15 - 10:15', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Biology', jamke: 'jam ke 7 - jam ke 8', jam: '10:30 - 11:30', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'History', jamke: 'jam ke 9 - jam ke 10', jam: '13:00 - 14:00', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Literature', jamke: 'jam ke 11 - jam ke 12', jam: '14:15 - 15:15', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'English', jamke: 'jam ke 13 - jam ke 14', jam: '15:30 - 16:30', jumlahSiswa: '30/30', color: 'green' },
                        { subject: 'Computer Science', jamke: 'jam ke 15 - jam ke 16', jam: '16:45 - 17:45', jumlahSiswa: '30/30', color: 'green' },
                    ]
                },
            ];
            const filteredSchedule = scheduleData.filter(item => item.day === selectedDay);
            return (
                <View style={{ flex: 1, backgroundColor: 'white' }}>

                    <View style={{ flexDirection: 'row', justifyContent: 'space-around', marginTop: 10, marginBottom: 20 }}>
                        <ScrollView horizontal={true} showsHorizontalScrollIndicator={false}>
                            {allDays.map(day => (
                                <TouchableOpacity
                                    key={day}
                                    onPress={() => setSelectedDay(day)}
                                    style={{
                                        padding: 10,
                                        backgroundColor: selectedDay === day ? '#4B7AD6' : 'lightgray',
                                        borderRadius: 5,
                                        marginRight: 10,
                                    }}>
                                    <Text style={{ color: selectedDay === day ? 'white' : 'black' }}>{day}</Text>
                                </TouchableOpacity>
                            ))}
                        </ScrollView>
                    </View>

                    <FlatList
                        data={filteredSchedule}

                        scrollEnabled={true}
                        keyExtractor={(item, index) => index.toString()}
                        contentContainerStyle={{ width: '100%' }}
                        renderItem={({ item }) => (
                            <View style={{ marginBottom: 20, width: '100%', padding: 5 }}>

                                <View>
                                    {item.events.map((event, index) => (
                                        <View key={index} style={{ marginBottom: 10, height: 100, backgroundColor: event.color, borderRadius: 10,  alignItems:'flex-end'}}>
                                          
                                            <View style={{ backgroundColor: 'white', padding: 10, marginLeft: 30, width: '90%', opacity: 0.7 }}>

                                                <View style={{ flexDirection: 'row', justifyContent: 'space-between' }}>
                                                    <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black' }}>{event.subject}</Text>
                                                    <View style={{ height: 30, width: 'auto', borderRadius: 8, backgroundColor: event.color, justifyContent: 'center', alignItems: 'center', paddingHorizontal: 10 }}>

                                                        <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>{event.jumlahSiswa}</Text>
                                                    </View>
                                                </View>

                                                <View style={{ height: 30, }} />
                                                <View style={{ flexDirection: 'row', justifyContent: 'space-between' }}>
                                                    <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black' }}>{event.jamke}</Text>
                                                    <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black' }}>{event.jam}</Text>
                                                </View>
                                            </View>
                                            <Text style={{ fontSize: 16, color: '#ffffff' }}>{index + 1} {event.subject}</Text>
                                        </View>
                                    ))}
                                </View>
                            </View>
                        )}
                    />
                </View>
            )
        } else {
            const allStudents = [
                {
                    "nama": "Tanaka Yuki",
                    "usia": 16,
                    "kelas": "11A",
                    "alamat": "Tokyo, Jepang",
                    "namaOrangtua": "Tanaka Ichiro",
                    "NISN": "1234567890"
                },
                {
                    "nama": "Suzuki Aiko",
                    "usia": 15,
                    "kelas": "10B",
                    "alamat": "Osaka, Jepang",
                    "namaOrangtua": "Suzuki Jiro",
                    "NISN": "0987654321"
                },
                {
                    "nama": "Watanabe Hiroshi",
                    "usia": 17,
                    "kelas": "12C",
                    "alamat": "Kyoto, Jepang",
                    "namaOrangtua": "Watanabe Hanako",
                    "NISN": "2345678901"
                },
                {
                    "nama": "Yamamoto Haruka",
                    "usia": 16,
                    "kelas": "11B",
                    "alamat": "Hiroshima, Jepang",
                    "namaOrangtua": "Yamamoto Takeshi",
                    "NISN": "3456789012"
                },
                {
                    "nama": "Ito Ayumu",
                    "usia": 15,
                    "kelas": "10A",
                    "alamat": "Nagoya, Jepang",
                    "namaOrangtua": "Ito Saki",
                    "NISN": "4567890123"
                }
            ];

            return (
                <View style={{ flex: 1, }}>
                    <FlatList
                        data={allStudents}
                        keyExtractor={(item, index) => index.toString()}
                        contentContainerStyle={{ marginTop: 10 }}
                        renderItem={({ item }) => (
                            <View style={{ marginBottom: 5, width: '100%', padding: 5 }}>
                                <Pressable onPress={() => LibNavigation.navigate('teacher/detailstudent', { data: item })} >
                                    <View style={{ flexDirection: 'row', backgroundColor: '#e7e7e7', borderRadius: 10, padding: 15 }}>
                                        <View style={{ marginRight: 10, width: 50, height: 50, borderRadius: 25, backgroundColor: 'lightgray' }} />
                                        <View style={{ marginBottom: 10, }}>
                                            <Text style={{ fontSize: 16, color: '#555' }}>{item.nama}</Text>
                                            <Text style={{ fontSize: 16, color: '#555' }}>{item.usia}</Text>
                                        </View>
                                    </View>
                                </Pressable>
                            </View>
                        )}
                    />
                </View>
            )
        }
    }
    return (
        <View style={{ padding: 20, flex: 1, ...shadowS(6) }}>

            <ScrollView showsVerticalScrollIndicator={false} >

                <View style={{ marginBottom: 30 }}>
                    <View style={{ justifyContent: 'flex-start', alignItems: 'center', flexDirection: 'row', }}>
                        <Pressable onPress={() => { LibNavigation.back() }} style={{ height: 40, borderRadius: 20, justifyContent: 'center', alignItems: 'center', }}>
                            <LibIcon.EntypoIcons name='chevron-left' size={35} color='gray' />
                        </Pressable>
                        <Text style={{ fontSize: 20, fontWeight: 'bold', color: '#000000' }}>Kelas Ku</Text>
                    </View>


                    <View style={{ flexDirection: 'row', backgroundColor: 'white', alignItems: 'center', justifyContent: 'space-between', marginTop: 50 }}>
                        <Text style={{ fontSize: 30, fontWeight: 'bold', color: 'black' }}>Kelas 8A</Text>
                        <View style={{ alignSelf: 'center', borderRadius: 10, backgroundColor: '#dfdfdf', opacity: 0.8, padding: 5 }}>
                            <Text style={{ fontSize: 20, fontWeight: 'bold', color: '#ff0000' }}>SoeHarto</Text>
                        </View>
                    </View>


                </View>
                <View style={{ flexDirection: 'row', margin: 20, justifyContent: 'center' }}>

                    <TouchableOpacity onPress={() => setSelectTab(allTabs[0])} key={0}
                        style={{
                            paddingVertical: 15, paddingHorizontal: 5, backgroundColor: selectTab === allTabs[0] ? '#136B93' : '#FFFFFF',
                            justifyContent: 'center', alignItems: 'center', marginLeft: 15, ...shadowS(6), width: LibStyle.width * 0.5 - 25, borderBottomLeftRadius: 10, borderTopLeftRadius: 10,

                        }}>
                        <Text style={{ color: selectTab === allTabs[0] ? '#FFFFFF' : '#000000', fontSize: 15, fontWeight: 'bold' }}>{allTabs[0]}</Text>
                    </TouchableOpacity>
                    <TouchableOpacity onPress={() => setSelectTab(allTabs[1])} key={1}
                        style={{
                            paddingVertical: 15, paddingHorizontal: 32, backgroundColor: selectTab === allTabs[1] ? '#136B93' : '#FFFFFF',
                            justifyContent: 'center', alignItems: 'center', marginRight: 15, ...shadowS(6), width: LibStyle.width * 0.5 - 25, borderBottomRightRadius: 10, borderTopRightRadius: 10,
                        }}>
                        <Text style={{ color: selectTab === allTabs[1] ? '#FFFFFF' : '#000000', fontSize: 15, fontWeight: 'bold' }}>{selectTab}</Text>
                    </TouchableOpacity>
                </View>

                <Tabs />
            </ScrollView>


        </View>
    )
}
export default memo(m)


